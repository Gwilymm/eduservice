<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
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
		if (!$data instanceof User) {
			throw new BadRequestHttpException("Invalid user data");
		}

		$errors = $this->validator->validate($data);
		if (count($errors) > 0) {
			throw new BadRequestHttpException((string) $errors);
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

		$this->entityManager->persist($data);
		$this->entityManager->flush();

		return $data; // 🔥 Ajouté pour que API Platform retourne l'utilisateur en JSON
	}
}
