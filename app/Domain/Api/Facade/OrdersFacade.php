<?php

declare(strict_types=1);

namespace App\Domain\Api\Facade;

use App\Domain\Api\Response\OrderResDto;
use App\Domain\Order\Order;

class OrdersFacade extends AbstractFacade
{
	/**
	 * @return array<int,OrderResDto>
	 */
	public function findAllOrders(): array
	{
		$customers = $this->entityManager->getRepository(Order::class)->findAll();

		$orderResDto = [];

		foreach ($customers as $customer) {
			$orderResDto[] = (new OrderResDto())->fromEntity($customer);
		}

		return $orderResDto;
	}

}
