<?php

declare(strict_types = 1);

namespace App\Domain\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateCustomerReqDto
{
    //close to must have annotation with assert (body navíc)
	/**
	 * @Assert\NotNull(message="Email is required.")
	 *
	 * @Assert\Email
	 */
	public string $email;

	/** @Assert\NotBlank */
	public string $name;

	/** @Assert\NotBlank */
	public string $surname;

	/** @Assert\NotBlank */
	public string $phone;

}
