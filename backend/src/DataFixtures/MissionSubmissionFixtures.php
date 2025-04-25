<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\MissionSubmission;
use App\Entity\User;
use App\Enum\MissionSubmissionStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MissionSubmissionFixtures extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager): void
	{
		$faker = Factory::create('fr_FR');

		// Récupération des ambassadeurs (utilisateurs non admin)
		$ambassadors = $manager->getRepository(User::class)->findByRole('ROLE_USER');

		// Si pas d'ambassadeurs, récupérer tous les utilisateurs
		if (empty($ambassadors)) {
			$ambassadors = $manager->getRepository(User::class)->findAll();
		}

		// Récupération des administrateurs
		$admins = $manager->getRepository(User::class)->findByRole('ROLE_ADMIN');

		// Si pas d'admins, prendre le premier utilisateur
		if (empty($admins)) {
			$admins = [$ambassadors[0]];
		}

		// Récupération de toutes les missions
		$missions = $manager->getRepository(Mission::class)->findAll();

		if (empty($missions) || empty($ambassadors)) {
			return; // Sortir si pas de missions ou d'ambassadeurs
		}

		// Création des soumissions de missions
		$totalSubmissions = 30; // Nombre de soumissions à créer

		for ($i = 0; $i < $totalSubmissions; $i++) {
			$submission = new MissionSubmission();

			// Sélection aléatoire d'un ambassadeur
			$ambassador = $faker->randomElement($ambassadors);
			$submission->setAmbassador($ambassador);

			// Sélection aléatoire d'une mission
			$mission = $faker->randomElement($missions);
			$submission->setMission($mission);

			// Création d'une date de soumission (entre 1 et 60 jours dans le passé)
			$submissionDate = $faker->dateTimeBetween('-60 days', '-1 days');
			$submission->setSubmissionDate($submissionDate);

			// Attribution aléatoire d'un statut
			$status = $faker->randomElement(MissionSubmissionStatus::cases());
			$submission->setStatus($status);

			// Ajout d'un exemple de chemin de preuve
			if ($mission->isRequiresProof()) {
				$submission->setProofPath('uploads/proofs/' . $faker->uuid . '.jpg');
			}

			// Traitement selon le statut
			if ($status === MissionSubmissionStatus::Approved || $status === MissionSubmissionStatus::Rejected) {
				// Date de validation entre la date de soumission et aujourd'hui
				$validationDate = $faker->dateTimeBetween($submissionDate, 'now');
				$submission->setValidationDate($validationDate);

				// Attribution d'un admin qui a validé/rejeté la soumission
				$admin = $faker->randomElement($admins);
				$submission->setAdmin($admin);

				// Si rejeté, ajouter une raison
				if ($status === MissionSubmissionStatus::Rejected) {
					$rejectionReasons = [
						'La preuve fournie n\'est pas suffisante.',
						'L\'image n\'est pas assez claire.',
						'La mission n\'a pas été effectuée correctement.',
						'La preuve ne correspond pas à la mission demandée.',
						'Document incomplet ou illisible.'
					];
					$submission->setRejectionReason($faker->randomElement($rejectionReasons));
				}
			}

			$manager->persist($submission);
		}

		$manager->flush();
	}

	public function getDependencies(): array
	{
		return [
			UserFixtures::class,
			MissionFixtures::class,
		];
	}
}
