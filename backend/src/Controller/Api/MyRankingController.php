<?php

namespace App\Controller\Api;

use App\Entity\MissionSubmission;
use App\Enum\MissionSubmissionStatus;
use App\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MyRankingController extends AbstractController
{
	#[Route('/api/challenges/{id}/my-ranking', name: 'api_my_ranking', methods: ['GET'])]
	#[IsGranted('ROLE_USER')]
	public function myRanking(
		int $id,
		EntityManagerInterface $em
	): JsonResponse {
		$user = $this->getUser();
		$challenge = $em->getRepository(Challenge::class)->find($id);
		if (!$challenge) {
			return $this->json(['error' => 'Challenge not found'], 404);
		}
		// Récupère toutes les soumissions validées de l'utilisateur pour ce challenge
		$qb = $em->createQueryBuilder();
		$qb->select('SUM(m.points) as totalPoints')
			->from(MissionSubmission::class, 'ms')
			->join('ms.mission', 'm')
			->where('ms.ambassador = :user')
			->andWhere('ms.status = :status')
			->andWhere('m.challenge = :challenge')
			->setParameter('user', $user)
			->setParameter('status', MissionSubmissionStatus::APPROVED)
			->setParameter('challenge', $challenge);
		$totalPoints = (int)($qb->getQuery()->getSingleScalarResult() ?? 0);

		// Calcul du rang de l'utilisateur
		$qb2 = $em->createQueryBuilder();
		$qb2->select('a.id, SUM(m.points) as points')
			->from(MissionSubmission::class, 'ms')
			->join('ms.mission', 'm')
			->join('ms.ambassador', 'a')
			->where('ms.status = :status')
			->andWhere('m.challenge = :challenge')
			->groupBy('a.id')
			->orderBy('points', 'DESC')
			->setParameter('status', MissionSubmissionStatus::APPROVED)
			->setParameter('challenge', $challenge);
		$results = $qb2->getQuery()->getResult();
		$rank = null;
		foreach ($results as $i => $row) {
			if ($row['id'] == $user->getId()) {
				$rank = $i + 1;
				break;
			}
		}
		$totalParticipants = count($results);

		return $this->json([
			'points' => $totalPoints,
			'rank' => $rank,
			'totalParticipants' => $totalParticipants
		]);
	}
}
