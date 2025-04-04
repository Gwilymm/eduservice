<?php

namespace App\Controller;

use App\Dto\Output\RankingOutput;
use App\Repository\ChallengeRepository;
use App\Repository\UserRepository;
use App\Repository\RewardRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[AsController]
final class RankingController
{
    public function __invoke(
        Request $request,
        UserRepository $userRepo,
        RewardRepository $rewardRepo,
        ChallengeRepository $challengeRepo,
        EntityManagerInterface $em
    ): JsonResponse {
        $school = $request->query->get('school');
        $challengeLabel = $request->query->get('schoolYear'); // reste identique côté front
        $missionType = $request->query->get('missionType');

        $qb = $userRepo->createQueryBuilder('u')
    ->select('u.id, u.firstName, u.lastName, u.shcoolName, SUM(m.points) AS totalPoints, c.label AS challengeLabel')
    ->join('u.missions', 'm')
    ->join('m.challenge', 'c')
    ->where('u.roles LIKE :ambassador')
    ->setParameter('ambassador', '%ROLE_AMBASSADOR%')
    ->groupBy('u.id')
    ->orderBy('totalPoints', 'DESC');


        if ($school) {
            $qb->andWhere('s.name = :school')->setParameter('school', $school);
        }

        if ($challengeLabel) {
            $qb->andWhere('c.label = :label')->setParameter('label', $challengeLabel);
        }

        if ($missionType) {
            $qb->andWhere('m.type = :type')->setParameter('type', $missionType);
        }

        $results = $qb->getQuery()->getResult();

        $output = [];
        $rank = 1;

        foreach ($results as $row) {
            $dto = new RankingOutput();
            $dto->rank = $rank++;
            $dto->ambassadorFullName = $row['firstName'] . ' ' . $row['lastName'];
            $dto->points = (int) $row['totalPoints'];
            $dto->school = $row['schoolName'];
            $dto->schoolYear = $row['challengeLabel'];

            // Récupération des récompenses atteintes
            $rewards = $rewardRepo->createQueryBuilder('r')
                ->where('r.minPoints <= :pts')
                ->setParameter('pts', $dto->points)
                ->orderBy('r.minPoints', 'ASC')
                ->getQuery()
                ->getResult();

            $dto->rewards = array_map(fn($r) => $r->getTitle(), $rewards);
            $output[] = $dto;
        }

        return new JsonResponse($output);
    }
}
