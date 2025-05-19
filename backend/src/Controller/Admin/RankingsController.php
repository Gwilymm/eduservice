<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\School;
use App\Entity\Challenge;
use App\Enum\MissionSubmissionStatus;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RankingsController extends AbstractCrudController
{
	private EntityManagerInterface $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public static function getEntityFqcn(): string
	{
		return User::class;
	}

	public function index(AdminContext $context): Response
	{
		$request = $context->getRequest();

		// Récupération des filtres
		$selectedChallenge = $request->query->get('challenge');
		$selectedSchool = $request->query->get('school');

		// Récupération de tous les challenges pour le filtre
		$challenges = $this->entityManager
			->getRepository(Challenge::class)
			->findBy([], ['academicYear' => 'DESC']);

		// Récupération de toutes les écoles pour le filtre
		$schools = $this->entityManager
			->getRepository(School::class)
			->findBy([], ['name' => 'ASC']);

		// Construction de la requête de base
		$queryBuilder = $this->entityManager->createQueryBuilder()
			->select('u.id, u.firstName, u.lastName, s.name as schoolName, c.academicYear as challengeName, SUM(m.points) as totalPoints')
			->from('App\Entity\MissionSubmission', 'ms')
			->join('ms.ambassador', 'u')
			->join('ms.mission', 'm')
			->join('m.challenge', 'c')
			->join('u.school', 's')
			->where('u.roles LIKE :role')
			->andWhere('ms.status = :status')
			->groupBy('u.id, u.firstName, u.lastName, s.name, c.academicYear')
			->orderBy('totalPoints', 'DESC')
			->setParameter('role', '%"ROLE_AMBASSADOR"%')
			->setParameter('status', MissionSubmissionStatus::Approved);

		// Application des filtres si présents
		if ($selectedChallenge && $selectedChallenge !== '') {
			$queryBuilder
				->andWhere('c.id = :challengeId')
				->setParameter('challengeId', (int)$selectedChallenge);
		}

		if ($selectedSchool && $selectedSchool !== '') {
			$queryBuilder
				->andWhere('s.id = :schoolId')
				->setParameter('schoolId', (int)$selectedSchool);
		}

		$results = $queryBuilder->getQuery()->getResult();

		// Préparer les données pour le template
		return $this->render('admin/rankings.html.twig', [
			'rankings' => $results,
			'challenges' => $challenges,
			'schools' => $schools,
			'selectedChallenge' => $selectedChallenge,
			'selectedSchool' => $selectedSchool
		]);
	}
}
