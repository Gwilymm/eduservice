<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\School;
use App\DataFixtures\SchoolFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
	private UserPasswordHasherInterface $passwordHasher;

	// Constantes pour référencer les utilisateurs dans d'autres fixtures
	public const ADMIN_USER = 'admin_user';
	public const AMBASSADOR_PREFIX = 'ambassador_';

	public function __construct(UserPasswordHasherInterface $passwordHasher)
	{
		$this->passwordHasher = $passwordHasher;
	}

	public function load(ObjectManager $manager): void
	{
		$faker = FakerFactory::create('fr_FR');

		// Créer un administrateur par école
		foreach (SchoolFixtures::REFERENCES as $schoolRef) {
			$admin = new User();
			$admin->setEmail(sprintf('admin.%s@eduservice.fr', strtolower($schoolRef)));
			$admin->setRoles(['ROLE_ADMIN']);
			$admin->setFirstName($faker->firstName());
			$admin->setLastName($faker->lastName());
			$admin->setPhoneNumber($faker->phoneNumber());

			// Récupère l'école depuis les références de SchoolFixtures
			// Correction: passer le nom de classe comme second paramètre à getReference
			$school = $this->getReference($schoolRef, School::class);
			$admin->setSchool($school);

			// Définir un mot de passe hashé
			$plainPassword = 'password'; // En prod, utiliser un mot de passe plus sécurisé
			$hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
			$admin->setPassword($hashedPassword);

			$manager->persist($admin);

			// Enregistrer la référence pour l'admin
			$this->addReference(self::ADMIN_USER . '_' . $schoolRef, $admin);

			// Créer 4 à 8 ambassadeurs par école
			$ambassadorCount = $faker->numberBetween(4, 8);

			for ($i = 0; $i < $ambassadorCount; $i++) {
				$ambassador = new User();

				$firstName = $faker->firstName();
				$lastName = $faker->lastName();

				$ambassador->setFirstName($firstName);
				$ambassador->setLastName($lastName);
				$ambassador->setEmail(strtolower(sprintf(
					'%s.%s@student.%s.fr',
					$firstName,
					$lastName,
					strtolower(str_replace(' ', '', $school->getName()))
				)));
				$ambassador->setRoles(['ROLE_AMBASSADOR']);
				$ambassador->setPhoneNumber($faker->phoneNumber());
				$ambassador->setSchool($school);

				// Définir un mot de passe hashé
				$plainPassword = 'password'; // En prod, utiliser un mot de passe plus sécurisé
				$hashedPassword = $this->passwordHasher->hashPassword($ambassador, $plainPassword);
				$ambassador->setPassword($hashedPassword);

				$manager->persist($ambassador);

				// Enregistrer la référence pour l'ambassadeur
				$this->addReference(self::AMBASSADOR_PREFIX . $schoolRef . '_' . $i, $ambassador);
			}
		}

		$manager->flush();
	}

	public function getDependencies(): array
	{
		return [
			SchoolFixtures::class,
		];
	}
}
