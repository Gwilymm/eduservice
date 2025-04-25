<?php

namespace App\Entity;

use App\Entity\Mission;
use App\Entity\Ranking;
use App\Dto\Input\UserInput;
use App\Dto\Input\UserUpdateInput;
use App\State\UserProcessor;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\MissionSubmission;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource(
    security: "is_granted('ROLE_ADMIN')",
    operations: [
        new Post(
            uriTemplate: '/register',
            security: "is_granted('PUBLIC_ACCESS')",
            input: UserInput::class,
            processor: UserProcessor::class,
            denormalizationContext: ['groups' => ['user:write']],
            output: false, // ✅ AUCUNE REPONSE DOCUMENTÉE
            openapi: new Operation(
                summary: 'Inscription d\'un ambassadeur',
                description: 'Création d\'un ambassadeur'
            ),

        ),
        new Get(),                // GET /api/users/{id}
        new GetCollection(),      // GET /api/users
        new Patch(
            input: UserUpdateInput::class,
            processor: UserProcessor::class,
            denormalizationContext: ['groups' => ['user:update']],
            openapi: new Operation(
                summary: 'Mise à jour d\'un utilisateur',
                description: 'Modification d\'un utilisateur avec possibilité de ne pas modifier le mot de passe'
            )
        ),
        new Delete(),
    ]
)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    // Propriété non persistée pour le mot de passe en clair
    private ?string $plainPassword = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * @var Collection<int, Mission>
     */
    #[ORM\OneToMany(targetEntity: Mission::class, mappedBy: 'admin')]
    private Collection $missions;

    /**
     * @var Collection<int, MissionSubmission>
     */
    #[ORM\OneToMany(targetEntity: MissionSubmission::class, mappedBy: 'ambassador')]
    private Collection $missionSubmissions;

    /**
     * @var Collection<int, Ranking>
     */
    #[ORM\OneToMany(targetEntity: Ranking::class, mappedBy: 'ambassador')]
    private Collection $rankings;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?School $school = null;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->missionSubmissions = new ArrayCollection();
        $this->rankings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the plain password (non-persisted field)
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set the plain password (non-persisted field)
     */
    public function setPlainPassword(?string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->setAdmin($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getAdmin() === $this) {
                $mission->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MissionSubmission>
     */
    public function getMissionSubmissions(): Collection
    {
        return $this->missionSubmissions;
    }

    public function addMissionSubmission(MissionSubmission $missionSubmission): static
    {
        if (!$this->missionSubmissions->contains($missionSubmission)) {
            $this->missionSubmissions->add($missionSubmission);
            $missionSubmission->setAmbassador($this);
        }

        return $this;
    }

    public function removeMissionSubmission(MissionSubmission $missionSubmission): static
    {
        if ($this->missionSubmissions->removeElement($missionSubmission)) {
            // set the owning side to null (unless already changed)
            if ($missionSubmission->getAmbassador() === $this) {
                $missionSubmission->setAmbassador(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ranking>
     */
    public function getRankings(): Collection
    {
        return $this->rankings;
    }

    public function addRanking(Ranking $ranking): static
    {
        if (!$this->rankings->contains($ranking)) {
            $this->rankings->add($ranking);
            $ranking->setAmbassador($this);
        }

        return $this;
    }

    public function removeRanking(Ranking $ranking): static
    {
        if ($this->rankings->removeElement($ranking)) {
            // set the owning side to null (unless already changed)
            if ($ranking->getAmbassador() === $this) {
                $ranking->setAmbassador(null);
            }
        }

        return $this;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): static
    {
        $this->school = $school;

        return $this;
    }

    // Ce champ n’est pas en base, juste utilisé pour la désérialisation
    private ?int $schoolId = null;

    public function getSchoolId(): ?int
    {
        return $this->schoolId;
    }

    public function setSchoolId(?int $schoolId): static
    {
        $this->schoolId = $schoolId;
        return $this;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function __toString(): string
    {
        return $this->getFullName();
    }
}
