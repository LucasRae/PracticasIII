<?php

namespace App\Entity;

use App\Repository\ParticipantesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantesRepository::class)]
class Participantes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participantes')]
    private ?Obra $Obra = null;

    #[ORM\ManyToOne(inversedBy: 'participantes')]
    private ?Persona $Persona = null;

    #[ORM\ManyToOne(inversedBy: 'participantes')]
    private ?Rol $Rol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObra(): ?Obra
    {
        return $this->Obra;
    }

    public function setObra(?Obra $Obra): static
    {
        $this->Obra = $Obra;

        return $this;
    }

    public function getPersona(): ?Persona
    {
        return $this->Persona;
    }

    public function setPersona(?Persona $Persona): static
    {
        $this->Persona = $Persona;

        return $this;
    }

    public function getRol(): ?Rol
    {
        return $this->Rol;
    }

    public function setRol(?Rol $Rol): static
    {
        $this->Rol = $Rol;

        return $this;
    }
}
