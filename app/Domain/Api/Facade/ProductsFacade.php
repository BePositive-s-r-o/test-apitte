<?php

declare(strict_types=1);

namespace App\Domain\Api\Facade;

use App\Domain\Api\Request\CreateCustomerReqDto;
use App\Domain\Api\Request\CreateProductReqDto;
use App\Domain\Api\Response\ProductResDto;
use App\Domain\Customer\Customer;
use App\Domain\Product\Product;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;

class ProductsFacade extends AbstractFacade
{
	/**
	 * @return array<int,ProductResDto>
	 */
	public function findAllProducts(): array
	{
		$customers = $this->entityManager->getRepository(Product::class)->findAll();

		$productResDto = [];

		foreach ($customers as $customer) {
			$productResDto[] = (new ProductResDto())->fromEntity($customer);
		}

		return $productResDto;
	}

	/**
	 * @throws EntityNotFoundException
	 */
	public function findOneById(int $id): ProductResDto
	{
		$customer = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $id]);

		if ($customer === null) {
			throw new EntityNotFoundException();
		}

		return (new ProductResDto())->fromEntity($customer);
	}

	public function create(CreateProductReqDto $createProductReqDto): Product
	{
		$product = new Product();
		$product->setName($createProductReqDto->name);
		$product->setEan($createProductReqDto->ean);
		$product->setPrice($createProductReqDto->price);
		$product->setCreatedAt();

		$this->entityManager->persist($product);
		$this->entityManager->flush();

		return $product;
	}

}
