<?php

namespace App\EventSubscriber;

use App\Entity\MissionSubmission;
use App\Enum\MissionSubmissionStatus;
use App\Service\RankingCalculator;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;

class MissionSubmissionSubscriber implements EventSubscriberInterface
{
	private RankingCalculator $rankingCalculator;
	private LoggerInterface $logger;

	public function __construct(RankingCalculator $rankingCalculator, LoggerInterface $logger)
	{
		$this->rankingCalculator = $rankingCalculator;
		$this->logger = $logger;
	}

	public static function getSubscribedEvents(): array
	{
		return [
			Events::postUpdate,
		];
	}

	public function postUpdate($entity, LifecycleEventArgs $args): void
	{
		if (!$entity instanceof MissionSubmission) {
			return;
		}
		$this->logger->info('MissionSubmissionSubscriber: postUpdate', [
			'id' => $entity->getId(),
			'status' => $entity->getStatus()
		]);
		// Si la soumission vient d'être validée
		if ($entity->getStatus() === MissionSubmissionStatus::APPROVED) {
			$mission = $entity->getMission();
			if ($mission && $mission->getChallenge()) {
				$this->logger->info('MissionSubmissionSubscriber: recalculating ranking', [
					'challengeId' => $mission->getChallenge()->getId()
				]);
				$this->rankingCalculator->recalculateForChallenge($mission->getChallenge());
			}
		}
	}
}
