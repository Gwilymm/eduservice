<?php

namespace App\Service;

use App\Entity\Challenge;
use App\Entity\Ranking;
use App\Entity\User;
use App\Entity\MissionSubmission;
use App\Enum\MissionSubmissionStatus;
use Doctrine\ORM\EntityManagerInterface;

class RankingCalculator
{
	private EntityManagerInterface $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	/**
	 * Recalcule le classement pour un challenge donné (année scolaire)
	 */
	public function recalculateForChallenge(Challenge $challenge): void
	{
		// 1. Récupérer toutes les soumissions validées pour ce challenge
		$qb = $this->em->createQueryBuilder();
		$qb->select('a.id AS userId, SUM(m.points) AS totalPoints')
			->from(MissionSubmission::class, 'ms')
			->join('ms.mission', 'm')
			->join('ms.ambassador', 'a')
			->where('ms.status = :status')
			->andWhere('m.challenge = :challenge')
			->setParameter('status', MissionSubmissionStatus::APPROVED)
			->setParameter('challenge', $challenge)
			->groupBy('a.id');
		$results = $qb->getQuery()->getResult();

		// 2. Mettre à jour ou créer les Rankings
		foreach ($results as $row) {
			$user = $this->em->getRepository(User::class)->find($row['userId']);
			$ranking = $this->em->getRepository(Ranking::class)->findOneBy([
				'ambassador' => $user,
				'challenge' => $challenge
			]);
			if (!$ranking) {
				$ranking = new Ranking();
				$ranking->setAmbassador($user);
				$ranking->setChallenge($challenge);
				$this->em->persist($ranking);
			}
			$ranking->setPoints((int)$row['totalPoints']);
		}
		$this->em->flush();
	}
}
