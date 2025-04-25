<?php

namespace App\Controller\Admin;

use App\Entity\School;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class SchoolCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return School::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setEntityLabelInSingular('École')
			->setEntityLabelInPlural('Écoles')
			->setSearchFields(['name'])
			->setDefaultSort(['name' => 'ASC']);
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			TextField::new('name', 'Nom de l\'école'),
			AssociationField::new('users', 'Utilisateurs')
				->onlyOnDetail()
				->setFormTypeOption('by_reference', false),
		];
	}

	public function configureActions(Actions $actions): Actions
	{
		return $actions
			->add(Crud::PAGE_INDEX, Action::DETAIL)
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setLabel('Ajouter une école');
			})
			->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
				return $action->setLabel('Modifier');
			})
			->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
				return $action->setLabel('Voir');
			});
	}
}
