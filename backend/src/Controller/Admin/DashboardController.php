<?php

namespace App\Controller\Admin;

use App\Entity\Challenge;
use App\Entity\Mission;
use App\Entity\MissionSubmission;
use App\Entity\School;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Utilisation du template de dashboard personnalisé
        return $this->render('admin/dashboard.html.twig');

        // Si vous préférez être redirigé directement vers la liste des missions,
        // commentez le code ci-dessus et décommentez le code ci-dessous
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(MissionCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration Eduservices');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        // Section Challenges et Missions
        yield MenuItem::section('Gestion des défis');
        yield MenuItem::linkToCrud('Challenges', 'fa fa-trophy', Challenge::class);
        yield MenuItem::linkToCrud('Missions', 'fa fa-tasks', Mission::class);
        yield MenuItem::linkToCrud('Soumissions', 'fa fa-check-square', MissionSubmission::class);

        // Section Configuration
        yield MenuItem::section('Configuration');
        yield MenuItem::linkToCrud('Écoles', 'fa fa-university', School::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);

        // Lien vers la partie frontend
        yield MenuItem::section('Liens');
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-undo', 'api_entrypoint');
    }
}
