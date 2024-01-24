<?php

namespace App\Entity;

use App\Repository\ExamResultsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamResultsRepository::class)]
class ExamResults
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateExam = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $result = null;

    #[ORM\Column]
    private ?bool $isComplete = null;

    #[ORM\ManyToOne(inversedBy: 'examResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    #[ORM\ManyToOne(inversedBy: 'examResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exams $fk_id_exam = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateExam(): ?\DateTimeInterface
    {
        return $this->dateExam;
    }

    public function setDateExam(\DateTimeInterface $dateExam): static
    {
        $this->dateExam = $dateExam;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(int $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function isIsComplete(): ?bool
    {
        return $this->isComplete;
    }

    public function setIsComplete(bool $isComplete): static
    {
        $this->isComplete = $isComplete;

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

    public function getFkIdExam(): ?Exams
    {
        return $this->fk_id_exam;
    }

    public function setFkIdExam(?Exams $fk_id_exam): static
    {
        $this->fk_id_exam = $fk_id_exam;

        return $this;
    }
}
