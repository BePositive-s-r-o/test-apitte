<?php

declare(strict_types=1);

namespace App\Domain\Customer;

use App\Model\Database\Entity\AbstractEntity;
use App\Model\Database\Entity\TCreatedAt;
use App\Model\Database\Entity\TId;
use App\Model\Database\Entity\TUpdatedAt;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer extends AbstractEntity
{
	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	#[ORM\Column(type: Types::STRING, length: 125)]
	private string $name;

	#[ORM\Column(type: Types::STRING, length: 125)]
	private string $surname;
	#[ORM\Column(type: Types::STRING, length: 125)]
	private string $email;

	#[ORM\Column(type: Types::STRING, length: 25)]
	private string $phone;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getSurname(): string
	{
		return $this->surname;
	}

	public function setSurname(string $surname): void
	{
		$this->surname = $surname;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

}
