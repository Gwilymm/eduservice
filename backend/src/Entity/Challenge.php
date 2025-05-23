<?php

namespace App\Entity;

use App\Entity\Mission;
use App\Entity\Ranking;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ChallengeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
#[ApiResource(
    operations: [
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Get(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new GetCollection(security: "is_granted('ROLE_USER')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]

class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $academicYear = null;

    /**
     * @var Collection<int, Mission>
     */
    #[ORM\OneToMany(targetEntity: Mission::class, mappedBy: 'challenge')]
    private Collection $missions;

    /**
     * @var Collection<int, Ranking>
     */
    #[ORM\OneToMany(targetEntity: Ranking::class, mappedBy: 'challenge')]
    private Collection $rankings;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $missionEnd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sponsorshipEnd = null;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->rankings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcademicYear(): ?string
    {
        return $this->academicYear;
    }

    public function setAcademicYear(string $academicYear): static
    {
        $this->academicYear = $academicYear;

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
            $mission->setChallenge($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getChallenge() === $this) {
                $mission->setChallenge(null);
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
            $ranking->setChallenge($this);
        }

        return $this;
    }

    public function removeRanking(Ranking $ranking): static
    {
        if ($this->rankings->removeElement($ranking)) {
            // set the owning side to null (unless already changed)
            if ($ranking->getChallenge() === $this) {
                $ranking->setChallenge(null);
            }
        }

        return $this;
    }

    public function getMissionEnd(): ?\DateTimeInterface
    {
        return $this->missionEnd;
    }

    public function setMissionEnd(\DateTimeInterface $missionEnd): static
    {
        $this->missionEnd = $missionEnd;

        return $this;
    }

    public function getSponsorshipEnd(): ?\DateTimeInterface
    {
        return $this->sponsorshipEnd;
    }

    public function setSponsorshipEnd(\DateTimeInterface $sponsorshipEnd): static
    {
        $this->sponsorshipEnd = $sponsorshipEnd;

        return $this;
    }

    /**
     * Convertit l'objet Challenge en chaîne pour l'affichage dans les formulaires et listes
     */
    public function __toString(): string
    {
        return $this->academicYear ?? 'Challenge #' . $this->id;
    }
}
