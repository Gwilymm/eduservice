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

		// Hacher le mot de passe avant de sauvegarder
		$data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));

		$this->entityManager->persist($data);
		$this->entityManager->flush();

		return $data; // 🔥 Ajouté pour que API Platform retourne l'utilisateur en JSON
	}
}
