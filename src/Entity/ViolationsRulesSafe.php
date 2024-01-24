<?php

namespace App\Entity;

use App\Repository\ViolationsRulesSafeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViolationsRulesSafeRepository::class)]
class ViolationsRulesSafe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_violation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'violationsRulesSafes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateViolation(): ?\DateTimeInterface
    {
        return $this->date_violation;
    }

    public function setDateViolation(\DateTimeInterface $date_violation): static
    {
        $this->date_violation = $date_violation;

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

    public function getFkIdEmployee(): ?Employee
    {
        return $this->fk_id_employee;
    }

    public function setFkIdEmployee(?Employee $fk_id_employee): static
    {
        $this->fk_id_employee = $fk_id_employee;

        return $this;
    }
}
