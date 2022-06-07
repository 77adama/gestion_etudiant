<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $date;

    // #[ORM\Column(type: 'integer')]
    // private $ac_id;

    // #[ORM\Column(type: 'integer')]
    // private $anneeScolaire_id;

    // #[ORM\Column(type: 'integer')]
    // private $classe_id;

    // #[ORM\Column(type: 'integer')]
    // private $etudiant_id;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $classe;

    #[ORM\ManyToOne(targetEntity: AnneeScolaire::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $anneescolaire;

    #[ORM\ManyToOne(targetEntity: Ac::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $ac;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $etudiant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAcId(): ?int
    {
        return $this->ac_id;
    }

    public function setAcId(int $ac_id): self
    {
        $this->ac_id = $ac_id;

        return $this;
    }

    public function getAnneeScolaireId(): ?int
    {
        return $this->anneeScolaire_id;
    }

    public function setAnneeScolaireId(int $anneeScolaire_id): self
    {
        $this->anneeScolaire_id = $anneeScolaire_id;

        return $this;
    }

    public function getClasseId(): ?int
    {
        return $this->classe_id;
    }

    public function setClasseId(int $classe_id): self
    {
        $this->classe_id = $classe_id;

        return $this;
    }

    public function getEtudiantId(): ?int
    {
        return $this->etudiant_id;
    }

    public function setEtudiantId(int $etudiant_id): self
    {
        $this->etudiant_id = $etudiant_id;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getAnneescolaire(): ?AnneeScolaire
    {
        return $this->anneescolaire;
    }

    public function setAnneescolaire(?AnneeScolaire $anneescolaire): self
    {
        $this->anneescolaire = $anneescolaire;

        return $this;
    }

    public function getAc(): ?Ac
    {
        return $this->ac;
    }

    public function setAc(?Ac $ac): self
    {
        $this->ac = $ac;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

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
