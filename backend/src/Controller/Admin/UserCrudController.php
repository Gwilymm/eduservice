<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
	private EntityManagerInterface $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
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

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			EmailField::new('email'),
			TextField::new('firstName', 'Prénom'),
			TextField::new('lastName', 'Nom'),
			TextField::new('phoneNumber', 'Téléphone')->hideOnIndex(),
			AssociationField::new('school', 'École')
				->setFormTypeOption('choice_label', 'name'),
			TextField::new('password')
				->onlyOnForms()
				->setFormType(PasswordType::class)
				->setFormTypeOptions([
					'attr' => ['autocomplete' => 'new-password'],
				]),
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
}
