<?php

namespace App\Controller\Admin;

use App\Entity\Challenge;
use App\Enum\ChallengeStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class ChallengeCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Challenge::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			TextField::new('academicYear', 'Année académique'),
			DateTimeField::new('missionEnd', 'Date de fin des missions'),
			DateTimeField::new('sponsorshipEnd', 'Date de fin du parrainage'),
			CollectionField::new('missions', 'Missions')->onlyOnDetail(),
			CollectionField::new('rankings', 'Classements')->onlyOnDetail(),
		];
	}
}
