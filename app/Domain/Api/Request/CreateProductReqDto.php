<?php

declare(strict_types = 1);

namespace App\Domain\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateProductReqDto
{
    //close to must have annotation with assert (body navíc)
	/** @Assert\NotBlank */
	/** @Assert\NotNull */
	public string $name;

	/** @Assert\NotBlank */
	/** @Assert\NotNull */
	public int $price;

	/** @Assert\NotBlank */
	/** @Assert\NotNull */
	public string $ean;
}
