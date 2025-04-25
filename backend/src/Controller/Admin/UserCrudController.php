<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
	private EntityManagerInterface $entityManager;
	private UserPasswordHasherInterface $passwordHasher;

	public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
	{
		$this->entityManager = $entityManager;
		$this->passwordHasher = $passwordHasher;
	}

	public static function getEntityFqcn(): string
	{
		return User::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setEntityLabelInSingular('Utilisateur')
			->setEntityLabelInPlural('Utilisateurs');
	}

	public function configureFilters(Filters $filters): Filters
	{
		return $filters
			->add(EntityFilter::new('school', 'École'));
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			EmailField::new('email'),
			TextField::new('firstName', 'Prénom'),
			TextField::new('lastName', 'Nom'),
			ArrayField::new('roles', 'Rôle')
				->formatValue(function ($value, $entity) {
					$roles = $entity->getRoles();

					// Déterminer le rôle le plus élevé selon la hiérarchie
					if (in_array('ROLE_SUPER_ADMIN', $roles)) {
						return '<span class="badge badge-danger">Super Admin</span>';
					} elseif (in_array('ROLE_ADMIN', $roles)) {
						return '<span class="badge badge-success">Administrateur</span>';
					} else {
						return '<span class="badge badge-primary">Étudiant</span>';
					}
				})
				->onlyOnIndex(),
			TextField::new('phoneNumber', 'Téléphone')->hideOnIndex(),
			AssociationField::new('school', 'École')
				->setFormTypeOption('choice_label', 'name'),
			TextField::new('plainPassword', 'Mot de passe')
				->setFormType(PasswordType::class)
				->onlyOnForms()
				->setRequired($pageName === Crud::PAGE_NEW)

				->setHelp($pageName === Crud::PAGE_NEW
					? 'Mot de passe pour le nouvel utilisateur'
					: 'Laissez vide pour conserver le mot de passe actuel'),
			ArrayField::new('roles')
				->setHelp('Format: ["ROLE_ADMIN"], ["ROLE_USER"], etc.')
				->onlyOnForms(),
		];
	}

	public function configureActions(Actions $actions): Actions
	{
		return $actions
			->add(Crud::PAGE_INDEX, Action::DETAIL);
	}

	/**
	 * @param User $entityInstance
	 */
	public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
	{
		$this->handlePassword($entityInstance);
		parent::updateEntity($entityManager, $entityInstance);
	}

	/**
	 * @param User $entityInstance
	 */
	public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
	{
		$this->handlePassword($entityInstance);
		parent::persistEntity($entityManager, $entityInstance);
	}

	/**
	 * @param User $entityInstance
	 */
	private function handlePassword(User $entityInstance): void
	{
		$plainPassword = $entityInstance->getPlainPassword();

		// Modifier le mot de passe uniquement s'il est fourni
		if (!empty($plainPassword)) {
			$hashedPassword = $this->passwordHasher->hashPassword(
				$entityInstance,
				$plainPassword
			);
			$entityInstance->setPassword($hashedPassword);
		}

		// Toujours effacer le mot de passe en clair pour des raisons de sécurité
		$entityInstance->setPlainPassword(null);
	}
}
