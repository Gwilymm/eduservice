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

		if ($data->getSchoolId()) {
			$school = $this->entityManager->getRepository(\App\Entity\School::class)->find($data->getSchoolId());
			if (!$school) {
				throw new BadRequestHttpException("Invalid school ID: " . $data->getSchoolId());
			}
			$data->setSchool($school);
		}

		// Hacher le mot de passe avant de sauvegarders
		$data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
