<?php

declare(strict_types=1);

namespace App\Domain\Api\Response;

use App\Domain\Order\Order;
use DateTimeImmutable;

class OrderResDto
{
	public int $id;
	public DateTimeImmutable $createdAt;
	public ?DateTimeImmutable $updatedAt;
	public int $customerId;
	public int $productId;
	public int $price;

    //nice to have static (body navíc)
	public function fromEntity(Order $order): self
	{
		$this->id = $order->getId();
		$this->createdAt = $order->getCreatedAt();
		$this->updatedAt = $order->getUpdatedAt();
		$this->customerId = $order->getCustomer()->getId();
		$this->productId = $order->getProduct()->getId();
		$this->price = $order->getPrice();

		return $this;
	}

}
