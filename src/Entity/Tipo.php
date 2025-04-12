<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoRepository::class)]
class Tipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nombre = null;

    #[ORM\OneToMany(targetEntity: Obra::class, mappedBy: 'Tipo')]
    private Collection $obras;

    public function __construct()
    {
        $this->obras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection<int, Obra>
     */
    public function getObras(): Collection
    {
        return $this->obras;
    }

    public function addObra(Obra $obra): static
    {
        if (!$this->obras->contains($obra)) {
            $this->obras->add($obra);
            $obra->setTipo($this);
        }

        return $this;
    }

    public function removeObra(Obra $obra): static
    {
        if ($this->obras->removeElement($obra)) {
            // set the owning side to null (unless already changed)
            if ($obra->getTipo() === $this) {
                $obra->setTipo(null);
            }
        }

        return $this;
    }
}
