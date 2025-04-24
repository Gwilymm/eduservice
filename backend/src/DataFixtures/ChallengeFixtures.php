<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChallengeFixtures extends Fixture
{
	// Constantes pour référencer les challenges dans d'autres fixtures
	public const CHALLENGE_2023_2024 = 'challenge_2023_2024';
	public const CHALLENGE_2024_2025 = 'challenge_2024_2025';
	public const CHALLENGE_2025_2026 = 'challenge_2025_2026';

	public function load(ObjectManager $manager): void
	{
		$academicYears = [
			self::CHALLENGE_2023_2024 => '2023-2024',
			self::CHALLENGE_2024_2025 => '2024-2025',
			self::CHALLENGE_2025_2026 => '2025-2026',
		];

		foreach ($academicYears as $reference => $academicYear) {
			$challenge = new Challenge();
			$challenge->setAcademicYear($academicYear);

			$manager->persist($challenge);

			// Enregistrer la référence pour pouvoir la récupérer dans d'autres fixtures
			$this->addReference($reference, $challenge);
		}

		$manager->flush();
	}
}
