<?php

declare(strict_types=1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Domain\Api\Facade\OrdersFacade;

/**
 * @Path("/orders")
 * @Tag("Orders")
 */
class OrdersController extends BasePubV1Controller
{

	public function __construct(private readonly OrdersFacade $orderFacade)
	{}

	/**
	 * @Path("/")
	 * @Method("GET")
	 * @OpenApi("summary: List of orders.")
	 */
	public function index(ApiRequest $apiRequest, ApiResponse $apiResponse): ApiResponse
	{
		$orders = $this->orderFacade->findAllOrders();

		return $apiResponse->writeJsonBody($orders)
			->withStatus(ApiResponse::S200_OK);
	}

}
