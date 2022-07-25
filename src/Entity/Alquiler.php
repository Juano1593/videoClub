<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alquiler
 *
 * @ORM\Table(name="alquiler")
 * @ORM\Entity
 */
class Alquiler
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_peliculas", type="integer", nullable=false)
     */
    private $idPeliculas;

    /**
     * @var int|null
     *
     * @ORM\Column(name="valor_total", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $valorTotal = NULL;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fechaFin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $cliente ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPeliculas(): ?int
    {
        return $this->idPeliculas;
    }

    public function setIdPeliculas(int $idPeliculas): self
    {
        $this->idPeliculas = $idPeliculas;

        return $this;
    }

    public function getValorTotal(): ?int
    {
        return $this->valorTotal;
    }

    public function setValorTotal(?int $valorTotal): self
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getCliente(): ?string
    {
        return $this->cliente;
    }

    public function setCliente(?string $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }


}
