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
use App\Domain\Api\Facade\CustomersFacade;
use App\Domain\Api\Request\CreateCustomerReqDto;
use App\Domain\Api\Response\CustomerResDto;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Utils\Caster;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Http\IResponse;

/**
 * @Path("/customers")
 * @Tag("Customers")
 */
class CustomersController extends BasePubV1Controller
{

    //must have using Facade
	public function __construct(private readonly CustomersFacade $customersFacade)
	{
	}

    //close to must have annotation response body (body navíc)
    //method name is not good shoud be list, findAll, etc. (body navíc)
	/**
	 * @Path("/")
	 * @Method("GET")
	 * @OpenApi("summary: List customers.")
	 */
	public function index(ApiRequest $apiRequest, ApiResponse $apiResponse): ApiResponse
	{
		$customers = $this->customersFacade->findAllCustomers();

		return $apiResponse->writeJsonBody($customers)
			->withStatus(ApiResponse::S200_OK);
	}

    //close to must have annotation response body (body navíc)
    //close to must have throwing exception (body navíc)
	/**
	 * @OpenApi("
	 *   summary: Get customer by id.
	 * ")
	 * @Path("/{id}")
	 * @Method("GET")
	 */
	public function byId(ApiRequest $request): CustomerResDto
	{
		try {
			return $this->customersFacade->findOneById(Caster::toInt($request->getParameter('id')));
		} catch (EntityNotFoundException) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NotFound);
		}
	}

    //close to must have annotation response body (body navíc)
	/**
	 * @OpenApi("
	 *   summary: Create new customer.
	 * ")
	 * @Path("/create")
	 * @Method("POST")
	 * @RequestBody(entity="App\Domain\Api\Request\CreateCustomerReqDto")
	 */
	public function create(ApiRequest $request, ApiResponse $response): ApiResponse
	{
		/** @var CreateCustomerReqDto $dto */
		$dto = $request->getParsedBody();

		try {
			$this->customersFacade->create($dto);

			return $response->withStatus(IResponse::S201_Created)
				->withHeader('Content-Type', 'application/json');
		} catch (DriverException $e) {
			throw ServerErrorException::create()
				->withMessage('Cannot create user')
				->withPrevious($e);
		}
	}

}
