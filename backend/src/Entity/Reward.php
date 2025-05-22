<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RewardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RewardRepository::class)]
#[ApiResource()]
class Reward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $minPoints = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isUniqueReward = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPoints(): ?int
    {
        return $this->minPoints;
    }

    public function setMinPoints(int $minPoints): static
    {
        $this->minPoints = $minPoints;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isUniqueReward(): ?bool
    {
        return $this->isUniqueReward;
    }

    public function setIsUniqueReward(bool $isUniqueReward): static
    {
        $this->isUniqueReward = $isUniqueReward;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Récompense #' . $this->id;
    }
}
