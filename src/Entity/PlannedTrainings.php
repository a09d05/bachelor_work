<?php

namespace App\Entity;

use App\Repository\PlannedTrainingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlannedTrainingsRepository::class)]
class PlannedTrainings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTrain = null;

    #[ORM\ManyToOne(inversedBy: 'plannedTrainings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Courses $fk_id_course = null;

    #[ORM\ManyToOne(inversedBy: 'plannedTrainings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTrain(): ?\DateTimeInterface
    {
        return $this->dateTrain;
    }

    public function setDateTrain(\DateTimeInterface $dateTrain): static
    {
        $this->dateTrain = $dateTrain;

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
