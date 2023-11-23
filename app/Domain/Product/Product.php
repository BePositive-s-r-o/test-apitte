<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TCreatedAt;
use App\Model\Database\Entity\TId;
use App\Model\Database\Entity\TUpdatedAt;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product extends AbstractEntity
{
	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	#[ORM\Column(type: Types::STRING, length: 255)]
	private string $name;

	#[ORM\Column(type: Types::INTEGER)]
	private int $price;

	#[ORM\Column(type: Types::STRING, length: 255)]
	private string $ean;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getPrice(): int
	{
		return $this->price;
	}

	public function setPrice(int $price): void
	{
		$this->price = $price;
	}

	public function getEan(): string
	{
		return $this->ean;
	}

	public function setEan(string $ean): void
	{
		$this->ean = $ean;
	}

}
