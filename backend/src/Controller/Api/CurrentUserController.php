<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\User;

class CurrentUserController extends AbstractController
{
	public function __invoke(#[CurrentUser] ?User $data): Response
	{
		if (!$data) {
			throw $this->createAccessDeniedException();
		}

		// renvoie un JSON serialisé avec le group "user:read"
		return $this->json(
			$data,
			Response::HTTP_OK,
			[],

		);
	}
}
