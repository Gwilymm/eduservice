<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Input\UserInput;
use App\Entity\User;
use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserProcessor implements ProcessorInterface
{
	private EntityManagerInterface $entityManager;
	private UserPasswordHasherInterface $passwordHasher;
	private ValidatorInterface $validator;

	public function __construct(
		EntityManagerInterface $entityManager,
		UserPasswordHasherInterface $passwordHasher,
		ValidatorInterface $validator
	) {
		$this->entityManager = $entityManager;
		$this->passwordHasher = $passwordHasher;
		$this->validator = $validator;
	}

	public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
	{
		// Handle UserInput DTO
		if ($data instanceof UserInput) {
			$user = new User();
			$user->setEmail($data->email);
			$user->setPassword($data->password);
			$user->setFirstName($data->firstName);
			$user->setLastName($data->lastName);
			$user->setPhoneNumber($data->phoneNumber);
			
			// Handle school relationship
			$school = $this->entityManager->getRepository(School::class)->find($data->school);
			if (!$school) {
				throw new BadRequestHttpException("Invalid school ID: " . $data->school);
			}
			$user->setSchool($school);
			
			// Set default roles if needed
			$user->setRoles(['ROLE_USER']);
			
			// Validate the created user
			$errors = $this->validator->validate($user);
			if (count($errors) > 0) {
				throw new BadRequestHttpException((string) $errors);
			}
			
			// Hash the password
			$user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
			
			$this->entityManager->persist($user);
			$this->entityManager->flush();
			
			return $user;
		}
		// Handle User entity
		else if ($data instanceof User) {
			$errors = $this->validator->validate($data);
			if (count($errors) > 0) {
				throw new BadRequestHttpException((string) $errors);
			}

			if ($data->getSchoolId()) {
				$school = $this->entityManager->getRepository(School::class)->find($data->getSchoolId());
				if (!$school) {
					throw new BadRequestHttpException("Invalid school ID: " . $data->getSchoolId());
				}
				$data->setSchool($school);
			}

			// Hash the password
			$data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));

			$this->entityManager->persist($data);
			$this->entityManager->flush();

			return $data;
		}
		else {
			throw new BadRequestHttpException("Invalid user data: Expected User or UserInput");
		}
	}
}
