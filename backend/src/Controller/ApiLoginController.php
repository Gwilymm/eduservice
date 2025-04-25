<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
	#[Route('/api/login', name: 'api_login', methods: ['POST'])]
	public function login(#[CurrentUser] ?User $user, Request $request, JWTTokenManagerInterface $jwtManager, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
	{
		$data = json_decode($request->getContent(), true);

		if (!isset($data['email']) || !isset($data['password'])) {
			return new JsonResponse(['error' => 'Missing email or password'], 400);
		}

		// Find user by email
		$user = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);

		if (!$user) {
			return new JsonResponse(['error' => 'Invalid credentials'], 401);
		}

		// Verify password
		if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
			return new JsonResponse(['error' => 'Invalid credentials'], 401);
		}

		// Generate JWT token
		$token = $jwtManager->create($user);

		// Return token in response for frontend storage
		return new JsonResponse([
			'id' => $user->getId(),
			'token' => $token,
		]);
	}
}
