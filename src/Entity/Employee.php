<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $surname = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $midName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startWorkDate = null;

    #[ORM\Column(length: 12)]
    private ?string $numberPhone = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployeePosts $fk_id_employeePost = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Depts $fk_id_dept = null;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: ExamResults::class)]
    private Collection $examResults;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: PlannedTrainings::class)]
    private Collection $plannedTrainings;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: ViolationsRulesSafe::class)]
    private Collection $violationsRulesSafes;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: FailedEmployees::class)]
    private Collection $failedEmployees;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: Exams::class)]
    private Collection $exams;

    #[ORM\OneToMany(mappedBy: 'fk_id_employee', targetEntity: CheckRequirementsWork::class)]
    private Collection $checkRequirementsWorks;

    public function __construct()
    {
        $this->examResults = new ArrayCollection();
        $this->plannedTrainings = new ArrayCollection();
        $this->violationsRulesSafes = new ArrayCollection();
        $this->failedEmployees = new ArrayCollection();
        $this->exams = new ArrayCollection();
        $this->checkRequirementsWorks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMidName(): ?string
    {
        return $this->midName;
    }

    public function setMidName(string $midName): static
    {
        $this->midName = $midName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getStartWorkDate(): ?\DateTimeInterface
    {
        return $this->startWorkDate;
    }

    public function setStartWorkDate(\DateTimeInterface $startWorkDate): static
    {
        $this->startWorkDate = $startWorkDate;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->numberPhone;
    }

    public function setNumberPhone(string $numberPhone): static
    {
        $this->numberPhone = $numberPhone;

        return $this;
    }

    public function getFkIdEmployeePost(): ?EmployeePosts
    {
        return $this->fk_id_employeePost;
    }

    public function setFkIdEmployeePost(?EmployeePosts $fk_id_employeePost): static
    {
        $this->fk_id_employeePost = $fk_id_employeePost;

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
            $examResult->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removeExamResult(ExamResults $examResult): static
    {
        if ($this->examResults->removeElement($examResult)) {
            // set the owning side to null (unless already changed)
            if ($examResult->getFkIdEmployee() === $this) {
                $examResult->setFkIdEmployee(null);
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
            $plannedTraining->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removePlannedTraining(PlannedTrainings $plannedTraining): static
    {
        if ($this->plannedTrainings->removeElement($plannedTraining)) {
            // set the owning side to null (unless already changed)
            if ($plannedTraining->getFkIdEmployee() === $this) {
                $plannedTraining->setFkIdEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ViolationsRulesSafe>
     */
    public function getViolationsRulesSafes(): Collection
    {
        return $this->violationsRulesSafes;
    }

    public function addViolationsRulesSafe(ViolationsRulesSafe $violationsRulesSafe): static
    {
        if (!$this->violationsRulesSafes->contains($violationsRulesSafe)) {
            $this->violationsRulesSafes->add($violationsRulesSafe);
            $violationsRulesSafe->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removeViolationsRulesSafe(ViolationsRulesSafe $violationsRulesSafe): static
    {
        if ($this->violationsRulesSafes->removeElement($violationsRulesSafe)) {
            // set the owning side to null (unless already changed)
            if ($violationsRulesSafe->getFkIdEmployee() === $this) {
                $violationsRulesSafe->setFkIdEmployee(null);
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
            $failedEmployee->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removeFailedEmployee(FailedEmployees $failedEmployee): static
    {
        if ($this->failedEmployees->removeElement($failedEmployee)) {
            // set the owning side to null (unless already changed)
            if ($failedEmployee->getFkIdEmployee() === $this) {
                $failedEmployee->setFkIdEmployee(null);
            }
        }

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
            $exam->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removeExam(Exams $exam): static
    {
        if ($this->exams->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getFkIdEmployee() === $this) {
                $exam->setFkIdEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CheckRequirementsWork>
     */
    public function getCheckRequirementsWorks(): Collection
    {
        return $this->checkRequirementsWorks;
    }

    public function addCheckRequirementsWork(CheckRequirementsWork $checkRequirementsWork): static
    {
        if (!$this->checkRequirementsWorks->contains($checkRequirementsWork)) {
            $this->checkRequirementsWorks->add($checkRequirementsWork);
            $checkRequirementsWork->setFkIdEmployee($this);
        }

        return $this;
    }

    public function removeCheckRequirementsWork(CheckRequirementsWork $checkRequirementsWork): static
    {
        if ($this->checkRequirementsWorks->removeElement($checkRequirementsWork)) {
            // set the owning side to null (unless already changed)
            if ($checkRequirementsWork->getFkIdEmployee() === $this) {
                $checkRequirementsWork->setFkIdEmployee(null);
            }
        }

        return $this;
    }
}
