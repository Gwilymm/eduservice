<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\MissionSubmissionStatus;
use App\Repository\MissionSubmissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionSubmissionRepository::class)]
#[ApiResource]
class MissionSubmission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'missionSubmissions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ambassador = null;

    #[ORM\ManyToOne(inversedBy: 'missionSubmissions')]
    private ?Mission $mission = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proofPath = null;

    #[ORM\Column(enumType: MissionSubmissionStatus::class)]
    private ?MissionSubmissionStatus $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $rejectionReason = null;

    #[ORM\ManyToOne(inversedBy: 'missionSubmissions')]
    private ?User $admin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $submissionDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $validationDate = null;

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

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getProofPath(): ?string
    {
        return $this->proofPath;
    }

    public function setProofPath(?string $proofPath): static
    {
        $this->proofPath = $proofPath;

        return $this;
    }

    public function getStatus(): ?MissionSubmissionStatus
    {
        return $this->status;
    }

    public function setStatus(MissionSubmissionStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRejectionReason(): ?string
    {
        return $this->rejectionReason;
    }

    public function setRejectionReason(?string $rejectionReason): static
    {
        $this->rejectionReason = $rejectionReason;

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

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTimeInterface $submissionDate): static
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validationDate;
    }

    public function setValidationDate(?\DateTimeInterface $validationDate): static
    {
        $this->validationDate = $validationDate;

        return $this;
    }
}
