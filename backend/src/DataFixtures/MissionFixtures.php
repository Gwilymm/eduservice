<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\Challenge;
use App\Entity\User;
use App\Enum\ChallengeStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class MissionFixtures extends Fixture implements DependentFixtureInterface
{
	private const MISSION_TYPES = [
		'Communication' => [
			'Partage sur les réseaux',
			'Représentation lors de salon',
			'Témoignage vidéo',
			'Animation de webinar',
			'Publication d\'article'
		],
		'Recrutement' => [
			'Intervention lycée',
			'Participation JPO',
			'Mentorat d\'étudiant',
			'Distribution flyers',
			'Présentation métier'
		],
		'Innovation' => [
			'Organisation hackathon',
			'Participation concours',
			'Workshop entreprise',
			'Développement projet',
			'Préparation événement'
		]
	];

	public function load(ObjectManager $manager): void
	{
		$faker = FakerFactory::create('fr_FR');

		// Récupération des challenges disponibles
		$challengeReferences = [
			ChallengeFixtures::CHALLENGE_2023_2024,
			ChallengeFixtures::CHALLENGE_2024_2025,
			ChallengeFixtures::CHALLENGE_2025_2026
		];

		// Pour chaque école, on crée des missions
		foreach (SchoolFixtures::REFERENCES as $schoolRef) {
			// Récupération de l'administrateur associé à l'école
			// Correction: passer le type comme second paramètre
			$admin = $this->getReference(UserFixtures::ADMIN_USER . '_' . $schoolRef, User::class);

			// Pour chaque type de mission
			foreach (self::MISSION_TYPES as $category => $missionTypes) {
				// Pour chaque challenge (année académique)
				foreach ($challengeReferences as $challengeRef) {
					// Correction: passer le type comme second paramètre
					$challenge = $this->getReference($challengeRef, Challenge::class);

					// On crée 1 à 3 missions par type
					foreach ($missionTypes as $missionType) {
						// On ne crée pas systématiquement toutes les missions pour diversifier
						if ($faker->boolean(80)) { // 80% de chance de créer cette mission
							$mission = new Mission();

							// Nom de la mission
							$mission->setName($category . ' : ' . $missionType);

							// Description détaillée avec Faker
							$mission->setDescription($faker->paragraphs(
								$faker->numberBetween(2, 4),
								true
							));

							// Points attribués entre 10 et 100
							$mission->setPoints($faker->numberBetween(10, 100));

							// Associer au challenge (année académique)
							$mission->setChallenge($challenge);

							// Associer à l'administrateur
							$mission->setAdmin($admin);

							// 40% des missions sont répétables
							$isRepeatable = $faker->boolean(40);
							$mission->setRepeatable($isRepeatable);

							// Si la mission est répétable, elle a un nombre max de répétitions
							if ($isRepeatable) {
								$mission->setMaxRepetitions($faker->numberBetween(3, 10));
							}

							// Status de la mission
							$statusArray = [
								ChallengeStatus::Created,
								ChallengeStatus::Active,
								ChallengeStatus::Paused,
								ChallengeStatus::Completed
							];

							// Les missions des années passées sont plus susceptibles d'être terminées
							if ($challengeRef === ChallengeFixtures::CHALLENGE_2023_2024) {
								$statusArray = [
									ChallengeStatus::Completed,
									ChallengeStatus::Completed,
									ChallengeStatus::Completed,
									ChallengeStatus::Paused
								];
							} elseif ($challengeRef === ChallengeFixtures::CHALLENGE_2024_2025) {
								$statusArray = [
									ChallengeStatus::Active,
									ChallengeStatus::Active,
									ChallengeStatus::Paused,
									ChallengeStatus::Completed
								];
							}

							$mission->setStatus($faker->randomElement($statusArray));

							// Définition aléatoire si la mission nécessite un justificatif (70% oui, 30% non)
							$mission->setRequiresProof($faker->boolean(70));

							$manager->persist($mission);
						}
					}
				}
			}
		}

		$manager->flush();
	}

	public function getDependencies(): array
	{
		return [
			UserFixtures::class,
			ChallengeFixtures::class,
		];
	}
}
