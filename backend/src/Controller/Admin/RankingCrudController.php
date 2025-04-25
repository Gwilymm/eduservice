<?php

namespace App\Controller\Admin;

use App\Entity\Ranking;
use App\Repository\RankingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class RankingCrudController extends AbstractCrudController
{
	private UserRepository $userRepository;
	private EntityManagerInterface $entityManager;
	private RequestStack $requestStack;
	private RankingRepository $rankingRepository;

	public function __construct(
		UserRepository $userRepository,
		EntityManagerInterface $entityManager,
		RequestStack $requestStack,
		RankingRepository $rankingRepository
	) {
		$this->userRepository = $userRepository;
		$this->entityManager = $entityManager;
		$this->requestStack = $requestStack;
		$this->rankingRepository = $rankingRepository;
	}

	public static function getEntityFqcn(): string
	{
		return Ranking::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setEntityLabelInSingular('Classement Ambassadeur')
			->setEntityLabelInPlural('Classements des Ambassadeurs')
			->setPageTitle(Crud::PAGE_INDEX, 'Classement des Ambassadeurs')
			->setDefaultSort(['points' => 'DESC'])
			->showEntityActionsInlined(true)
			->setPaginatorPageSize(50); // Plus d'entrées par page pour voir le classement complet
	}

	public function configureFields(string $pageName): iterable
	{
		// Champ pour afficher le rang (calculé dynamiquement)
		yield Field::new('rank', 'Rang')
			->hideOnForm()
			->formatValue(function ($value, $entity) {
				// Le rang est calculé dynamiquement dans le contrôleur d'index
				// et stocké comme propriété temporaire
				return $entity->rank ?? '-';
			})
			->setCssClass('badge bg-secondary');

		yield AssociationField::new('ambassador', 'Ambassadeur')
			->setFormTypeOption('choice_label', 'fullName');

		yield TextField::new('ambassador.school', 'École')
			->hideOnForm()
			->formatValue(function ($value, $entity) {
				return $entity->getAmbassador() && $entity->getAmbassador()->getSchool()
					? $entity->getAmbassador()->getSchool()->getName()
					: 'Non définie';
			});

		yield AssociationField::new('challenge', 'Challenge/Année')
			->setFormTypeOption('choice_label', 'academicYear');

		yield IntegerField::new('points', 'Points')
			->setTemplatePath('admin/field/points_badge.html.twig')
			->setSortable(true);
	}

	public function configureFilters(Filters $filters): Filters
	{
		return $filters
			->add('ambassador')
			->add('challenge')
			->add('points');
	}

	public function configureActions(Actions $actions): Actions
	{
		return $actions
			->add(Crud::PAGE_INDEX, Action::DETAIL)
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setLabel('Ajouter un classement');
			});
	}

	public function configureAssets(Assets $assets): Assets
	{
		return $assets
			->addCssFile('css/ranking.css');
	}

	/**
	 * Surcharge de la méthode de génération de requête pour ajouter le rang dynamique
	 */
	public function createIndexQueryBuilder(
		SearchDto $searchDto,
		EntityDto $entityDto,
		FieldCollection $fields,
		FilterCollection $filters
	): \Doctrine\ORM\QueryBuilder {
		$qb = $this->container->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);

		// Assurez-vous que le tri est par points décroissants pour le calcul du rang
		$qb->orderBy('entity.points', 'DESC');

		return $qb;
	}

	/**
	 * Surcharge de la méthode index pour ajouter le calcul du rang
	 */
	public function index(AdminContext $context): Response
	{
		$response = parent::index($context);

		// Si nous avons des entités dans le contexte, ajoutons le rang à chacune d'entre elles
		if ($context && ($entities = $context->getEntities()->getItems())) {
			$rank = 1;

			foreach ($entities as $entityDto) {
				// On ajoute la propriété rank à chaque entité
				$entity = $entityDto->getInstance();
				$entity->rank = $rank++;
			}
		}

		return $response;
	}
}
