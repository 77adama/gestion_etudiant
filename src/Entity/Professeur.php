<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends Personne
{


    #[ORM\Column(type: 'string', length: 255)]
    private $grade;

    // #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'professeurs')]
    // private $classes;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'professeurs')]
    private $module;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'professeurs')]
    private $classes;

    #[ORM\ManyToOne(targetEntity: Rp::class, inversedBy: 'professeurs')]
    #[ORM\JoinColumn(nullable: false)]
    private $rp;

    // #[ORM\ManyToOne(targetEntity: Rp::class, inversedBy: 'professeurs')]
    // private $rp;



 

    public function __construct()
    {
        $this->module = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getClasses(): ?Classe
    {
        return $this->classes;
    }

    public function setClasses(?Classe $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Module $module): self
    {
        if (!$this->module->contains($module)) {
            $this->module[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->module->removeElement($module);

        return $this;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        $this->classes->removeElement($class);

        return $this;
    }

    public function getRp(): ?Rp
    {
        return $this->rp;
    }

    public function setRp(?Rp $rp): self
    {
        $this->rp = $rp;

        return $this;
    }
}
