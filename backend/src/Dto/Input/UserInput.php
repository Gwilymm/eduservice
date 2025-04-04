<?php

namespace App\Dto\Input;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Serializer\Annotation\Groups;

class UserInput
{
    #[Groups(['user:write'])]
    public string $email;

    #[Groups(['user:write'])]
    public string $password;

    #[Groups(['user:write'])]
    public string $firstName;

    #[Groups(['user:write'])]
    public string $lastName;

    #[Groups(['user:write'])]
    public ?string $phoneNumber = null;

    #[Groups(['user:write'])]
    #[NotBlank]
    public int $school; // ici on accepte l'ID brut
}
