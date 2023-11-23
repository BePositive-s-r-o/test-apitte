<?php

declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\Customer\Customer;
use App\Domain\Product\Product;
use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TCreatedAt;
use App\Model\Database\Entity\TId;
use App\Model\Database\Entity\TUpdatedAt;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: OrderRepository::class)]
#[Table(name: 'orders')]
class Order extends AbstractEntity
{
	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	#[ManyToOne(targetEntity: Customer::class)]
	private Customer $customer;

	#[ManyToOne(targetEntity: Product::class)]
	private Product $product;

	#[Column(type: Types::INTEGER)]
	private int $price;

	public function getCustomer(): Customer
	{
		return $this->customer;
	}

	public function setCustomer(Customer $customer): void
	{
		$this->customer = $customer;
	}

	public function getProduct(): Product
	{
		return $this->product;
	}

	public function setProduct(Product $product): void
	{
		$this->product = $product;
	}

	public function getPrice(): int
	{
		return $this->price;
	}

	public function setPrice(int $price): void
	{
		$this->price = $price;
	}

}
