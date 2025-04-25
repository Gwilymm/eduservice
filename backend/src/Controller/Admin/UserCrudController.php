<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return User::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id')->hideOnForm(),
			EmailField::new('email'),
			TextField::new('password')
				->onlyOnForms()
				->setFormType(PasswordType::class)
				->setFormTypeOptions([
					'attr' => ['autocomplete' => 'new-password'],
					'hash_property_path' => 'password',
				]),
			ArrayField::new('roles'),
			BooleanField::new('isVerified', 'Vérifié'),
			IntegerField::new('points', 'Points')->hideOnForm(),
			AssociationField::new('school', 'École')->hideOnIndex(),
		];
	}
}
