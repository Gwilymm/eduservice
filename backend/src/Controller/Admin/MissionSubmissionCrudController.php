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
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class MissionSubmissionCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return MissionSubmission::class;
	}

	public function configureFields(string $pageName): iterable
	{
		$missionsField = AssociationField::new('mission', 'Mission')
			->setFormTypeOption('choice_label', 'name')
			->setQueryBuilder(function ($queryBuilder) {
				// Correction : le root alias est 'entity' dans EasyAdmin
				$now = new \DateTimeImmutable();
				$queryBuilder
					->join('entity.challenge', 'c')
					->where('c.missionEnd >= :now')
					->andWhere('c.missionEnd < :nextYear')
					->setParameter('now', (new \DateTimeImmutable('first day of January this year'))->setTime(0, 0))
					->setParameter('nextYear', (new \DateTimeImmutable('first day of January next year'))->setTime(0, 0));
				return $queryBuilder;
			});

		return [
			IdField::new('id')->hideOnForm(),

			$missionsField,

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

	public function configureActions(Actions $actions): Actions
	{
		$approve = Action::new('approve', 'Approuver', 'fa fa-check')
			->linkToCrudAction('approveSubmission')
			->addCssClass('btn-success')
			->displayIf(function ($entity) {
				return $entity->getStatus() !== MissionSubmissionStatus::APPROVED;
			}); // Pas de displayAsButton, EasyAdmin place le bouton dans la colonne si pas de section

		return $actions
			->add(Action::INDEX, $approve)
			->add(Action::DETAIL, $approve);
	}

	public function approveSubmission(AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em)
	{
		$id = $this->getContext()->getRequest()->query->get('entityId');
		$submission = $em->getRepository(MissionSubmission::class)->find($id);
		if ($submission) {
			if (is_string(MissionSubmissionStatus::APPROVED)) {
				$submission->setStatus(MissionSubmissionStatus::from('approved'));
			} else {
				$submission->setStatus(MissionSubmissionStatus::APPROVED);
			}
			$em->flush();
			$this->addFlash('success', 'Mission approuvée !');
		}
		$url = $adminUrlGenerator->setController(self::class)->setAction(Action::INDEX)->generateUrl();
		return new RedirectResponse($url);
	}
}
