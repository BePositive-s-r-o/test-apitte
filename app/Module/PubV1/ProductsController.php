<?php

declare(strict_types=1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\RequestBody;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Exception\Api\ClientErrorException;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Domain\Api\Facade\ProductsFacade;
use App\Domain\Api\Request\CreateCustomerReqDto;
use App\Domain\Api\Request\CreateProductReqDto;
use App\Domain\Api\Response\CustomerResDto;
use App\Domain\Api\Response\ProductResDto;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Utils\Caster;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Http\IResponse;

/**
 * @Path("/products")
 * @Tag("Products")
 */
class ProductsController extends BasePubV1Controller
{
	public function __construct(private readonly ProductsFacade $productsFacade)
	{
	}

	/**
	 * @Path("/")
	 * @Method("GET")
	 * @OpenApi("summary: List of products.")
	 */
	public function index(ApiRequest $apiRequest, ApiResponse $apiResponse): ApiResponse
	{
		$products = $this->productsFacade->findAllProducts();

		return $apiResponse->writeJsonBody($products)
			->withStatus(ApiResponse::S200_OK);
	}

	/**
	 * @OpenApi("
	 *   summary: Get product by id.
	 * ")
	 * @Path("/{id}")
	 * @Method("GET")
	 */
	public function byId(ApiRequest $request): ProductResDto
	{
		try {
			return $this->productsFacade->findOneById(Caster::toInt($request->getParameter('id')));
		} catch (EntityNotFoundException) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NotFound);
		}
	}

	/**
	 * @OpenApi("
	 *   summary: Create new product.
	 * ")
	 * @Path("/create")
	 * @Method("POST")
	 * @RequestBody(entity="App\Domain\Api\Request\CreateProductReqDto")
	 */
	public function create(ApiRequest $request, ApiResponse $response): ApiResponse
	{
		/** @var CreateProductReqDto $dto */
		$dto = $request->getParsedBody();

		try {
			$this->productsFacade->create($dto);

			return $response->withStatus(IResponse::S201_Created)
				->withHeader('Content-Type', 'application/json');
		} catch (DriverException $e) {
			throw ServerErrorException::create()
				->withMessage('Cannot create customer')
				->withPrevious($e);
		}
	}

}
