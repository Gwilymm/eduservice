<?php

namespace App\Dto\Input;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Serializer\Annotation\Groups;

class UserUpdateInput
{
	#[Groups(['user:update'])]
	public ?string $email = null;

	#[Groups(['user:update'])]
	public ?string $password = null;

	#[Groups(['user:update'])]
	public ?string $firstName = null;

	#[Groups(['user:update'])]
	public ?string $lastName = null;

	#[Groups(['user:update'])]
	public ?string $phoneNumber = null;

	#[Groups(['user:update'])]
	public ?int $school = null;
}
