<?php

namespace App\Entity;

use App\Repository\FailedEmployeesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FailedEmployeesRepository::class)]
class FailedEmployees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFail = null;

    #[ORM\ManyToOne(inversedBy: 'failedEmployees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    #[ORM\ManyToOne(inversedBy: 'failedEmployees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Courses $fk_id_course = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFail(): ?\DateTimeInterface
    {
        return $this->dateFail;
    }

    public function setDateFail(\DateTimeInterface $dateFail): static
    {
        $this->dateFail = $dateFail;

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

    public function getFkIdCourse(): ?Courses
    {
        return $this->fk_id_course;
    }

    public function setFkIdCourse(?Courses $fk_id_course): static
    {
        $this->fk_id_course = $fk_id_course;

        return $this;
    }
}
