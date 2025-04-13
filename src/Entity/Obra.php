<?php

namespace App\Entity;

use App\Repository\ObraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObraRepository::class)]
class Obra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $Sinopsis = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Fecha_salida = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Portada = null;

    #[ORM\ManyToOne(inversedBy: 'obras')]
    private ?Tipo $Tipo = null;

    #[ORM\ManyToMany(targetEntity: Genero::class, inversedBy: 'obras')]
    private Collection $Genero;

    public function __construct()
    {
        $this->Genero = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(string $Titulo): static
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->Sinopsis;
    }

    public function setSinopsis(string $Sinopsis): static
    {
        $this->Sinopsis = $Sinopsis;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->Fecha_salida;
    }

    public function setFechaSalida(?\DateTimeInterface $Fecha_salida): static
    {
        $this->Fecha_salida = $Fecha_salida;

        return $this;
    }

    public function getPortada(): ?string
    {
        return $this->Portada;
    }

    public function setPortada(?string $Portada): static
    {
        $this->Portada = $Portada;

        return $this;
    }

    public function getTipo(): ?Tipo
    {
        return $this->Tipo;
    }

    public function setTipo(?Tipo $Tipo): static
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * @return Collection<int, Genero>
     */
    public function getGenero(): Collection
    {
        return $this->Genero;
    }

    public function addGenero(Genero $genero): static
    {
        if (!$this->Genero->contains($genero)) {
            $this->Genero->add($genero);
        }

        return $this;
    }

    public function removeGenero(Genero $genero): static
    {
        $this->Genero->removeElement($genero);

        return $this;
    }

    public function __toString(): string
{
    return $this->Titulo ?? '';
}
}
