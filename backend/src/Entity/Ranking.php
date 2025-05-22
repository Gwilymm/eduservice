<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RankingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RankingRepository::class)]
#[ApiResource]
class Ranking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rankings')]
    private ?User $ambassador = null;

    #[ORM\ManyToOne(inversedBy: 'rankings')]
    private ?Challenge $challenge = null;

    #[ORM\Column]
    private int $points = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmbassador(): ?User
    {
        return $this->ambassador;
    }

    public function setAmbassador(?User $ambassador): static
    {
        $this->ambassador = $ambassador;

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

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function addPoints(int $points): static
    {
        $this->points += $points;

        return $this;
    }
}
