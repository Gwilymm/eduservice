<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Input\UserInput;
use App\Dto\Input\UserUpdateInput;
use App\Entity\User;
use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        // Traitement du DTO UserInput pour l'enregistrement
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
        // Traitement du DTO UserUpdateInput pour la mise à jour
        elseif ($data instanceof UserUpdateInput) {
            // Récupérer l'utilisateur existant depuis la base de données
            $userId = $uriVariables['id'] ?? null;
            if (!$userId) {
                throw new BadRequestHttpException("User ID not provided");
            }

            $user = $this->entityManager->getRepository(User::class)->find($userId);
            if (!$user) {
                throw new NotFoundHttpException("User not found with ID: " . $userId);
            }

            // Mettre à jour uniquement les champs fournis
            if ($data->email !== null) {
                $user->setEmail($data->email);
            }

            if ($data->firstName !== null) {
                $user->setFirstName($data->firstName);
            }

            if ($data->lastName !== null) {
                $user->setLastName($data->lastName);
            }

            if ($data->phoneNumber !== null) {
                $user->setPhoneNumber($data->phoneNumber);
            }

            // Mise à jour de l'école si fournie
            if ($data->school !== null) {
                $school = $this->entityManager->getRepository(School::class)->find($data->school);
                if (!$school) {
                    throw new BadRequestHttpException("Invalid school ID: " . $data->school);
                }
                $user->setSchool($school);
            }

            // Traitement du mot de passe uniquement s'il est fourni et non vide
            if ($data->password !== null && trim($data->password) !== '') {
                $user->setPassword($this->passwordHasher->hashPassword($user, $data->password));
            }
            // IMPORTANT: Ne pas mettre à null le mot de passe s'il n'est pas fourni
            // Le mot de passe existant est préservé automatiquement

            // Valider l'utilisateur mis à jour
            $errors = $this->validator->validate($user);
            if (count($errors) > 0) {
                throw new BadRequestHttpException((string) $errors);
            }

            $this->entityManager->flush();

            return $user;
        }
        // Traitement direct de l'entité User
        elseif ($data instanceof User) {
            $errors = $this->validator->validate($data);
            if (count($errors) > 0) {
                throw new BadRequestHttpException((string) $errors);
            }

            // Si c'est une mise à jour (l'ID existe)
            if ($data->getId()) {
                $originalUser = $this->entityManager->getRepository(User::class)->find($data->getId());

                // Si le mot de passe est vide ou null, conserver l'ancien
                if (!$data->getPassword() || trim($data->getPassword()) === '') {
                    $data->setPassword($originalUser->getPassword());
                } else {
                    // Sinon, hacher le nouveau mot de passe
                    $data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));
                }
            } else {
                // Pour une nouvelle entité, le mot de passe est obligatoire
                if (!$data->getPassword()) {
                    throw new BadRequestHttpException("Password is required for new users");
                }
                $data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));
            }

            if ($data->getSchoolId()) {
                $school = $this->entityManager->getRepository(School::class)->find($data->getSchoolId());
                if (!$school) {
                    throw new BadRequestHttpException("Invalid school ID: " . $data->getSchoolId());
                }
                $data->setSchool($school);
            }

            $this->entityManager->persist($data);
            $this->entityManager->flush();

            return $data;
        } else {
            throw new BadRequestHttpException("Invalid user data: Expected User, UserInput or UserUpdateInput");
        }
    }
}
