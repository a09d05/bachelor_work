<?php

namespace App\Entity;

use App\Repository\EmployeePostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeePostsRepository::class)]
class EmployeePosts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 90)]
    private ?string $name_post = null;

    #[ORM\OneToMany(mappedBy: 'fk_id_employeePost', targetEntity: Employee::class)]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePost(): ?string
    {
        return $this->name_post;
    }

    public function setNamePost(string $name_post): static
    {
        $this->name_post = $name_post;

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
            $employee->setFkIdEmployeePost($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getFkIdEmployeePost() === $this) {
                $employee->setFkIdEmployeePost(null);
            }
        }

        return $this;
    }
}
