<?php

namespace App\Entity;

use App\Repository\RegistroVentaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistroVentaRepository::class)]
class RegistroVenta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

   
    #[ORM\Column]
    private ?float $montoTotal = null;

    #[ORM\Column]
    private array $productos = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getMontoTotal(): ?float
    {
        return $this->montoTotal;
    }

    public function setMontoTotal(float $montoTotal): static
    {
        $this->montoTotal = $montoTotal;

        return $this;
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function setProductos(array $productos): static
    {
        $this->productos = $productos;

        return $this;
    }
}
