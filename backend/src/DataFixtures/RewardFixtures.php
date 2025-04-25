<?php

namespace App\DataFixtures;

use App\Entity\Reward;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RewardFixtures extends Fixture
{
	public function load(ObjectManager $manager): void
	{
		$faker = Factory::create('fr_FR');

		// Création de plusieurs récompenses avec différents seuils de points
		$rewardsData = [
			// Récompenses pour débutants (tier 1)
			[
				'title' => 'Badge Débutant',
				'description' => 'Badge digital pour les ambassadeurs qui commencent leur parcours.',
				'minPoints' => 100,
				'isUniqueReward' => true,
			],
			[
				'title' => 'E-certificat de participation',
				'description' => 'Certificat numérique attestant de votre implication dans le programme ambassadeur.',
				'minPoints' => 200,
				'isUniqueReward' => true,
			],

			// Récompenses intermédiaires (tier 2)
			[
				'title' => 'Invitation webinaire exclusif',
				'description' => 'Accès à un webinaire avec des professionnels du secteur.',
				'minPoints' => 500,
				'isUniqueReward' => false,
			],
			[
				'title' => 'Pack goodies Eduservices',
				'description' => 'Un ensemble de goodies de la marque (carnet, stylo, stickers).',
				'minPoints' => 750,
				'isUniqueReward' => true,
			],

			// Récompenses avancées (tier 3)
			[
				'title' => 'Bon d\'achat de 50€',
				'description' => 'Bon d\'achat utilisable dans plusieurs enseignes partenaires.',
				'minPoints' => 1200,
				'isUniqueReward' => false,
			],
			[
				'title' => 'Invitation à un événement professionnel',
				'description' => 'Entrée VIP pour un événement professionnel du secteur éducatif.',
				'minPoints' => 2000,
				'isUniqueReward' => true,
			],

			// Récompenses premium (tier 4)
			[
				'title' => 'Mentorat personnalisé',
				'description' => '3 sessions de mentorat avec un professionnel reconnu du secteur.',
				'minPoints' => 3000,
				'isUniqueReward' => true,
			],
			[
				'title' => 'Formation professionnelle certifiante',
				'description' => 'Accès à une formation certifiante dans le domaine de votre choix.',
				'minPoints' => 5000,
				'isUniqueReward' => true,
			],

			// Récompense ultime
			[
				'title' => 'Ambassadeur de l\'année',
				'description' => 'Reconnaissance officielle avec trophée et visibilité médiatique. Inclut également une bourse pour un projet personnel.',
				'minPoints' => 10000,
				'isUniqueReward' => true,
			],
		];

		foreach ($rewardsData as $index => $rewardData) {
			$reward = new Reward();
			$reward->setTitle($rewardData['title']);
			$reward->setDescription($rewardData['description']);
			$reward->setMinPoints($rewardData['minPoints']);
			$reward->setIsUniqueReward($rewardData['isUniqueReward']);

			$manager->persist($reward);

			// Référencer les récompenses pour pouvoir les utiliser dans d'autres fixtures
			$this->addReference('reward_' . $index, $reward);
		}

		// Générer quelques récompenses supplémentaires aléatoires
		for ($i = 0; $i < 5; $i++) {
			$reward = new Reward();
			$reward->setTitle($faker->catchPhrase());
			$reward->setDescription($faker->paragraph());
			$reward->setMinPoints($faker->numberBetween(100, 8000));
			$reward->setIsUniqueReward($faker->boolean(70)); // 70% de chances d'être unique

			$manager->persist($reward);
		}

		$manager->flush();
	}
}
