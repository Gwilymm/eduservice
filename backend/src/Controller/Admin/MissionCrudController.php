<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use App\Enum\ChallengeStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Titre'),
            TextareaField::new('description')->hideOnIndex(),
            IntegerField::new('points', 'Points'),
            AssociationField::new('challenge', 'Challenge'),
            AssociationField::new('admin', 'Administrateur')
                ->setFormTypeOption('choice_label', 'email'),
            BooleanField::new('repeatable', 'Répétable'),
            BooleanField::new('requiresProof', 'Preuve requise'),
            IntegerField::new('maxRepetitions', 'Répétitions max')
                ->hideOnIndex()
                ->setHelp('Nombre maximal de répétitions (si répétable)'),
            ChoiceField::new('status', 'Statut')
                ->setChoices(array_combine(
                    array_map(fn($status) => $status->value, ChallengeStatus::cases()),
                    ChallengeStatus::cases()
                ))
                ->renderAsBadges([
                    'created' => 'secondary',
                    'active' => 'success',
                    'paused' => 'warning',
                    'completed' => 'dark',
                ])
        ];
    }
}
