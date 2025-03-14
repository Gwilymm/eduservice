<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\ChallengeStatus;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
#[ApiResource]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Challenge $challenge = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $admin = null;

    #[ORM\Column]
    private ?bool $repeatable = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxRepetitions = null;

    #[ORM\Column(enumType: ChallengeStatus::class)]
    private ?ChallengeStatus $status = null;

    /**
     * @var Collection<int, MissionSubmission>
     */
    #[ORM\OneToMany(targetEntity: MissionSubmission::class, mappedBy: 'mission')]
    private Collection $missionSubmissions;

    public function __construct()
    {
        $this->missionSubmissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getChallenge(): ?Challenge
    {
        return $this->challenge;
    }

    public function setChallenge(?Challenge $challenge): static
    {
        $this->challenge = $challenge;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function isRepeatable(): ?bool
    {
        return $this->repeatable;
    }

    public function setRepeatable(bool $repeatable): static
    {
        $this->repeatable = $repeatable;

        return $this;
    }

    public function getMaxRepetitions(): ?int
    {
        return $this->maxRepetitions;
    }

    public function setMaxRepetitions(?int $maxRepetitions): static
    {
        $this->maxRepetitions = $maxRepetitions;

        return $this;
    }

    public function getStatus(): ?ChallengeStatus
    {
        return $this->status;
    }

    public function setStatus(ChallengeStatus $status): static
    {
        $this->status = $status;

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
            $missionSubmission->setMission($this);
        }

        return $this;
    }

    public function removeMissionSubmission(MissionSubmission $missionSubmission): static
    {
        if ($this->missionSubmissions->removeElement($missionSubmission)) {
            // set the owning side to null (unless already changed)
            if ($missionSubmission->getMission() === $this) {
                $missionSubmission->setMission(null);
            }
        }

        return $this;
    }
}
