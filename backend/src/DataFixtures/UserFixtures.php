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

		// Création d'un compte admin générique
		$admin = new User();
		$admin->setEmail('admin@eduservice.fr');
		$admin->setRoles(['ROLE_ADMIN']);
		$admin->setFirstName('Admin');
		$admin->setLastName('Test');
		$admin->setPhoneNumber('0600000000');
		$admin->setSchool($this->getReference(SchoolFixtures::AFTEC, School::class));
		$admin->setSchoolmail('admin@aftec.fr');
		$admin->setSection('A1');
		$plainPassword = 'Admin1234'; // Majuscule, minuscule, chiffre
		$hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
		$admin->setPassword($hashedPassword);
		$manager->persist($admin);
		$this->addReference('admin_test', $admin);

		// Création d'un compte user générique
		$user = new User();
		$user->setEmail('user@eduservice.fr');
		$user->setRoles(['ROLE_USER']);
		$user->setFirstName('User');
		$user->setLastName('Test');
		$user->setPhoneNumber('0600000001');
		$user->setSchool($this->getReference(SchoolFixtures::AFTEC, School::class));
		$user->setSchoolmail('user@aftec.fr');
		$user->setSection('A1');
		$plainPassword = 'User1234'; // Majuscule, minuscule, chiffre
		$hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
		$user->setPassword($hashedPassword);
		$manager->persist($user);
		$this->addReference('user_test', $user);

		// Créer un administrateur par école
		foreach (SchoolFixtures::REFERENCES as $schoolRef) {
			$admin = new User();
			$admin->setEmail(sprintf('admin.%s@eduservice.fr', strtolower($schoolRef)));
			$admin->setRoles(['ROLE_ADMIN']);
			$admin->setFirstName($faker->firstName());
			$admin->setLastName($faker->lastName());
			$admin->setPhoneNumber($faker->phoneNumber());

			$school = $this->getReference($schoolRef, School::class);
			$admin->setSchool($school);
			$admin->setSchoolmail(sprintf('admin.%s@%s.fr', strtolower($schoolRef), strtolower($schoolRef)));
			$admin->setSection('A1');

			$plainPassword = 'Admin1234';
			$hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
			$admin->setPassword($hashedPassword);

			$manager->persist($admin);
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
				$ambassador->setSchoolmail(strtolower(sprintf('%s.%s@%s.fr', $firstName, $lastName, strtolower($schoolRef))));
				$ambassador->setSection('A1');

				$plainPassword = 'User1234';
				$hashedPassword = $this->passwordHasher->hashPassword($ambassador, $plainPassword);
				$ambassador->setPassword($hashedPassword);

				$manager->persist($ambassador);
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
