<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class SecurityController extends AbstractController
{
    #[Route(path: '/admin/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, JWTTokenManagerInterface $jwtManager, Security $security, RequestStack $requestStack): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Génération du JWT si l'admin est connecté
        $user = $security->getUser();
        $jwt = null;
        if ($user) {
            $jwt = $jwtManager->create($user);
            // Stocker le JWT en session pour usage ultérieur
            $session = $requestStack->getSession();
            $session->set('admin_jwt', $jwt);
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'admin_jwt' => $jwt,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        // Redirige proprement vers la page de login après déconnexion
        return $this->redirectToRoute('app_login');
    }
}
