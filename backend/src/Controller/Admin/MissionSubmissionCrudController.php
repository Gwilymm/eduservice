<?php

namespace App\Controller\Admin;

use App\Entity\MissionSubmission;
use App\Enum\MissionSubmissionStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class MissionSubmissionCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return MissionSubmission::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),

			AssociationField::new('mission', 'Mission')
				->setFormTypeOption('choice_label', 'name'),

			AssociationField::new('ambassador', 'Ambassadeur')
				->formatValue(function ($value, $entity) {
					return $entity->getAmbassador() ? $entity->getAmbassador()->getFullName() : '';
				}),

			DateTimeField::new('submissionDate', 'Date de soumission'),

			ChoiceField::new('status', 'Statut')
				->setChoices(array_combine(
					array_map(fn($status) => $status->value, MissionSubmissionStatus::cases()),
					MissionSubmissionStatus::cases()
				))
				->renderAsBadges([
					'submitted' => 'warning',
					'approved' => 'success',
					'rejected' => 'danger',
				]),

			TextField::new('proofPath', 'Preuve')
				->hideOnIndex(),

			TextareaField::new('rejectionReason', 'Raison du rejet')
				->hideOnIndex(),

			DateTimeField::new('validationDate', 'Date de validation/rejet')
				->hideOnIndex(),

			AssociationField::new('admin', 'Administrateur')
				->formatValue(function ($value, $entity) {
					return $entity->getAdmin() ? $entity->getAdmin()->getFullName() : '';
				})
				->hideOnIndex(),
		];
	}
}
