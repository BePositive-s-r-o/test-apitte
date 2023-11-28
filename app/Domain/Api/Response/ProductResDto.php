<?php

declare(strict_types=1);

namespace App\Domain\Api\Response;

use App\Domain\Product\Product;
use DateTimeImmutable;

class ProductResDto
{
	public int $id;
	public DateTimeImmutable $createdAt;
	public ?DateTimeImmutable $updatedAt;
	public string $name;
	public int $price;
	public string $ean;

    //nice to have static (body navíc)
	public function fromEntity(Product $product): self
	{
		$this->id = $product->getId();
		$this->createdAt = $product->getCreatedAt();
		$this->updatedAt = $product->getUpdatedAt();
		$this->name = $product->getName();
		$this->price = $product->getPrice();
		$this->ean = $product->getEan();

		return $this;
	}

}
