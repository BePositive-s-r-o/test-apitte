<?php

declare(strict_types=1);

namespace App\Domain\Api\Facade;

use Doctrine\ORM\EntityManagerInterface;

class AbstractFacade
{
	public function __construct(protected readonly EntityManagerInterface $entityManager)
	{}

}
