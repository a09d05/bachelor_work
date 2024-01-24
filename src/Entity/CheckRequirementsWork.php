<?php

namespace App\Entity;

use App\Repository\CheckRequirementsWorkRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckRequirementsWorkRepository::class)]
class CheckRequirementsWork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $plannedCheckDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $factCheckDate = null;

    #[ORM\Column(length: 80)]
    private ?string $result = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comments = null;

    #[ORM\ManyToOne(inversedBy: 'checkRequirementsWorks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Depts $fk_id_dept = null;

    #[ORM\ManyToOne(inversedBy: 'checkRequirementsWorks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlannedCheckDate(): ?\DateTimeInterface
    {
        return $this->plannedCheckDate;
    }

    public function setPlannedCheckDate(\DateTimeInterface $plannedCheckDate): static
    {
        $this->plannedCheckDate = $plannedCheckDate;

        return $this;
    }

    public function getFactCheckDate(): ?\DateTimeInterface
    {
        return $this->factCheckDate;
    }

    public function setFactCheckDate(\DateTimeInterface $factCheckDate): static
    {
        $this->factCheckDate = $factCheckDate;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function getFkIdDept(): ?Depts
    {
        return $this->fk_id_dept;
    }

    public function setFkIdDept(?Depts $fk_id_dept): static
    {
        $this->fk_id_dept = $fk_id_dept;

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
