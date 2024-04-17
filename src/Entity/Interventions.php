<?php

namespace App\Entity;

use App\Repository\InterventionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionsRepository::class)]
class Interventions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_int = null;

    #[ORM\ManyToOne(targetEntity: Bornes::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id')]
    private ?Bornes $borne;

    #[ORM\Column(type: 'integer')]
    private ?int $id_emp;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $Date;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $Type;

    // Getters and setters
    public function getIdInt(): ?int
    {
        return $this->id_int;
    }

    public function getBorne(): ?Bornes
    {
        return $this->borne;
    }

    public function setBorne(?Bornes $borne): self
    {
        $this->borne = $borne;

        return $this;
    }

    public function getIdEmp(): ?int
    {
        return $this->id_emp;
    }

    public function setIdEmp(?int $id_emp): self
    {
        $this->id_emp = $id_emp;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
