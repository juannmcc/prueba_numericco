<?php

namespace App\Entity;

use App\Repository\PremiosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PremiosRepository::class)
 */
class Premios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\OneToMany(targetEntity=Codigos::class, mappedBy="id_premio")
     */
    private $codigos;

    public function __construct()
    {
        $this->codigos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection<int, Codigos>
     */
    public function getCodigos(): Collection
    {
        return $this->codigos;
    }

    public function addCodigo(Codigos $codigo): self
    {
        if (!$this->codigos->contains($codigo)) {
            $this->codigos[] = $codigo;
            $codigo->setIdPremio($this);
        }

        return $this;
    }

    public function removeCodigo(Codigos $codigo): self
    {
        if ($this->codigos->removeElement($codigo)) {
            // set the owning side to null (unless already changed)
            if ($codigo->getIdPremio() === $this) {
                $codigo->setIdPremio(null);
            }
        }

        return $this;
    }
}
