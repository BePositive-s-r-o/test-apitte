<?php

declare(strict_types = 1);

namespace App\Model\Database\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TCreatedAt
{
	#[ORM\Column(type: Types::DATE_IMMUTABLE)]
	protected DateTimeImmutable $createdAt;

	public function getCreatedAt(): DateTimeImmutable
	{
		return $this->createdAt;
	}

	public function setCreatedAt(): void
	{
		$this->createdAt = new DateTimeImmutable();
	}

	public function __construct()
	{
		$this->setCreatedAt();
	}

}
