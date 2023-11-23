<?php

declare(strict_types=1);

namespace App\Domain\Api\Response;

use App\Domain\Customer\Customer;
use DateTimeImmutable;

class CustomerResDto
{
	public int $id;
	public string $name;
	public string $surname;
	public string $email;
	public string $phone;
	public DateTimeImmutable $createdAt;
	public ?DateTimeImmutable $updatedAt;

	public function fromEntity(Customer $customer): self
	{
		$this->id = $customer->getId();
		$this->name = $customer->getName();
		$this->surname = $customer->getSurname();
		$this->email = $customer->getEmail();
		$this->phone = $customer->getPhone();
		$this->createdAt = $customer->getCreatedAt();
		$this->updatedAt = $customer->getUpdatedAt();

		return $this;
	}
}
