<?php

namespace App\DataFixtures;

use App\Entity\School;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

class SchoolFixtures extends Fixture
{
	// Constantes pour référencer les écoles dans d'autres fixtures
	public const AFTEC = 'AFTEC';
	public const IPAC = 'IPAC';
	public const MBWAY = 'MBWAY';
	public const WIN = 'WIN';
	public const MDS = 'MDS';
	public const IHECF = 'IHECF';
	public const TUNON = 'TUNON';

	// Liste des noms d'écoles comme demandé
	private const SCHOOL_NAMES = [
		'AFTEC',
		'Ipac Bachelor Factory',
		'MBway',
		'WIN Sport School',
		'MyDigitalSchool',
		'IHECF',
		"L'École internationale TUNON"
	];

	// Références pour accéder aux fixtures - changé de private à public
	public const REFERENCES = [
		self::AFTEC,
		self::IPAC,
		self::MBWAY,
		self::WIN,
		self::MDS,
		self::IHECF,
		self::TUNON
	];

	public function load(ObjectManager $manager): void
	{
		foreach (self::SCHOOL_NAMES as $index => $schoolName) {
			$school = new School();
			$school->setName($schoolName);

			$manager->persist($school);

			// Enregistrer la référence pour pouvoir la récupérer dans d'autres fixtures
			$this->addReference(self::REFERENCES[$index], $school);
		}

		$manager->flush();
	}
}
