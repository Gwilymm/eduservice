<?php

namespace App\State;

use App\Dto\Input\UserInput;
use App\Entity\User;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class UserProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
        private SchoolRepository $schoolRepo
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): User
    {
        assert($data instanceof UserInput);

        $user = new User();
        $user->setEmail($data->email);
        $user->setFirstName($data->firstName);
        $user->setLastName($data->lastName);
        $user->setPhoneNumber($data->phoneNumber);
        $user->setRoles(['ROLE_AMBASSADOR']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $data->password)
        );

        $school = $this->schoolRepo->find($data->school);
        if (!$school) {
            throw new \InvalidArgumentException('School ID is invalid');
        }

        $user->setSchool($school);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
