<?php

declare(strict_types=1);

namespace App\Domain\Api\Facade;

use App\Domain\Api\Request\CreateCustomerReqDto;
use App\Domain\Api\Response\CustomerResDto;
use App\Domain\Customer\Customer;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;

class CustomersFacade extends AbstractFacade
{
	/**
	 * @return array<int,CustomerResDto>
	 */
	public function findAllCustomers(): array
	{
		$customers = $this->entityManager->getRepository(Customer::class)->findAll();

		$customersResDto = [];

		foreach ($customers as $customer) {
			$customersResDto[] = (new CustomerResDto())->fromEntity($customer);
		}

		return $customersResDto;
	}

	/**
	 * @throws EntityNotFoundException
	 */
	public function findOneById(int $id): CustomerResDto
	{
		$customer = $this->entityManager->getRepository(Customer::class)->findOneBy(['id' => $id]);

		if ($customer === null) {
			throw new EntityNotFoundException();
		}

		return (new CustomerResDto())->fromEntity($customer);
	}

	public function create(CreateCustomerReqDto $customerResDto): Customer
	{
		$customer = new Customer();
		$customer->setName($customerResDto->name);
		$customer->setSurname($customerResDto->surname);
		$customer->setEmail($customerResDto->email);
		$customer->setPhone($customerResDto->phone);
		$customer->setCreatedAt();

		$this->entityManager->persist($customer);
		$this->entityManager->flush();

		return $customer;
	}

}
