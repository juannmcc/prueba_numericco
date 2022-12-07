<?php

namespace App\Entity;

use App\Repository\CodigosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodigosRepository::class)
 */
class Codigos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity=Premios::class, inversedBy="codigos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_premio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getIdPremio(): ?Premios
    {
        return $this->id_premio;
    }

    public function setIdPremio(?Premios $id_premio): self
    {
        $this->id_premio = $id_premio;

        return $this;
    }
}
