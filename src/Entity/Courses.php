<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $duration = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Documents $fk_id_document = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Multimedia $fk_id_media = null;

    #[ORM\OneToMany(mappedBy: 'fk_id_course', targetEntity: Exams::class)]
    private Collection $exams;

    #[ORM\OneToMany(mappedBy: 'fk_id_course', targetEntity: PlannedTrainings::class)]
    private Collection $plannedTrainings;

    #[ORM\OneToMany(mappedBy: 'fk_id_course', targetEntity: FailedEmployees::class)]
    private Collection $failedEmployees;

    public function __construct()
    {
        $this->exams = new ArrayCollection();
        $this->plannedTrainings = new ArrayCollection();
        $this->failedEmployees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getFkIdDocument(): ?Documents
    {
        return $this->fk_id_document;
    }

    public function setFkIdDocument(?Documents $fk_id_document): static
    {
        $this->fk_id_document = $fk_id_document;

        return $this;
    }

    public function getFkIdMedia(): ?Multimedia
    {
        return $this->fk_id_media;
    }

    public function setFkIdMedia(?Multimedia $fk_id_media): static
    {
        $this->fk_id_media = $fk_id_media;

        return $this;
    }

    /**
     * @return Collection<int, Exams>
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exams $exam): static
    {
        if (!$this->exams->contains($exam)) {
            $this->exams->add($exam);
            $exam->setFkIdCourse($this);
        }

        return $this;
    }

    public function removeExam(Exams $exam): static
    {
        if ($this->exams->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getFkIdCourse() === $this) {
                $exam->setFkIdCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlannedTrainings>
     */
    public function getPlannedTrainings(): Collection
    {
        return $this->plannedTrainings;
    }

    public function addPlannedTraining(PlannedTrainings $plannedTraining): static
    {
        if (!$this->plannedTrainings->contains($plannedTraining)) {
            $this->plannedTrainings->add($plannedTraining);
            $plannedTraining->setFkIdCourse($this);
        }

        return $this;
    }

    public function removePlannedTraining(PlannedTrainings $plannedTraining): static
    {
        if ($this->plannedTrainings->removeElement($plannedTraining)) {
            // set the owning side to null (unless already changed)
            if ($plannedTraining->getFkIdCourse() === $this) {
                $plannedTraining->setFkIdCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FailedEmployees>
     */
    public function getFailedEmployees(): Collection
    {
        return $this->failedEmployees;
    }

    public function addFailedEmployee(FailedEmployees $failedEmployee): static
    {
        if (!$this->failedEmployees->contains($failedEmployee)) {
            $this->failedEmployees->add($failedEmployee);
            $failedEmployee->setFkIdCourse($this);
        }

        return $this;
    }

    public function removeFailedEmployee(FailedEmployees $failedEmployee): static
    {
        if ($this->failedEmployees->removeElement($failedEmployee)) {
            // set the owning side to null (unless already changed)
            if ($failedEmployee->getFkIdCourse() === $this) {
                $failedEmployee->setFkIdCourse(null);
            }
        }

        return $this;
    }
}
