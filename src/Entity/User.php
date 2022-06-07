<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role", type:"string")]
#[ORM\DiscriminatorMap(["rp"=>"Rp","ac"=>"Ac","etudiant"=>"Etudiant"])]

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends Personne
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected $loging;

    #[ORM\Column(type: 'string', length: 255)]
    protected $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoging(): ?string
    {
        return $this->loging;
    }

    public function setLoging(string $loging): self
    {
        $this->loging = $loging;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
