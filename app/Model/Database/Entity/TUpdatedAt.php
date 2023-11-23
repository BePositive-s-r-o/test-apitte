<?php

declare(strict_types = 1);

namespace App\Model\Database\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TUpdatedAt
{
	#[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
	protected ?DateTimeImmutable $updatedAt = null;

	public function getUpdatedAt(): ?DateTimeImmutable
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(): void
	{
		$this->updatedAt = new DateTimeImmutable();
	}

}
