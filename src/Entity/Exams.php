<?php

namespace App\Entity;

use App\Repository\ExamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamsRepository::class)]
class Exams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $answer = [];

    #[ORM\ManyToOne(inversedBy: 'exams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Courses $fk_id_course = null;

    #[ORM\OneToMany(mappedBy: 'fk_id_exam', targetEntity: ExamResults::class)]
    private Collection $examResults;

    #[ORM\ManyToOne(inversedBy: 'exams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $fk_id_employee = null;

    public function __construct()
    {
        $this->examResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): array
    {
        return $this->answer;
    }

    public function setAnswer(array $answer): static
    {
        $this->answer = $answer;

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

    /**
     * @return Collection<int, ExamResults>
     */
    public function getExamResults(): Collection
    {
        return $this->examResults;
    }

    public function addExamResult(ExamResults $examResult): static
    {
        if (!$this->examResults->contains($examResult)) {
            $this->examResults->add($examResult);
            $examResult->setFkIdExam($this);
        }

        return $this;
    }

    public function removeExamResult(ExamResults $examResult): static
    {
        if ($this->examResults->removeElement($examResult)) {
            // set the owning side to null (unless already changed)
            if ($examResult->getFkIdExam() === $this) {
                $examResult->setFkIdExam(null);
            }
        }

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
