<?php

namespace App\Entity;

use App\Repository\DeptsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeptsRepository::class)]
class Depts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $dept_name = null;

    #[ORM\OneToMany(mappedBy: 'fk_id_dept', targetEntity: CheckRequirementsWork::class)]
    private Collection $checkRequirementsWorks;

    #[ORM\OneToMany(mappedBy: 'fk_id_dept', targetEntity: Employee::class)]
    private Collection $employees;

    public function __construct()
    {
        $this->checkRequirementsWorks = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeptName(): ?string
    {
        return $this->dept_name;
    }

    public function setDeptName(string $dept_name): static
    {
        $this->dept_name = $dept_name;

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
            $checkRequirementsWork->setFkIdDept($this);
        }

        return $this;
    }

    public function removeCheckRequirementsWork(CheckRequirementsWork $checkRequirementsWork): static
    {
        if ($this->checkRequirementsWorks->removeElement($checkRequirementsWork)) {
            // set the owning side to null (unless already changed)
            if ($checkRequirementsWork->getFkIdDept() === $this) {
                $checkRequirementsWork->setFkIdDept(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setFkIdDept($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getFkIdDept() === $this) {
                $employee->setFkIdDept(null);
            }
        }

        return $this;
    }
}
