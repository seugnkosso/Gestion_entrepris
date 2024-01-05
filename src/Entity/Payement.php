<?php

namespace App\Entity;

use App\Repository\PayementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PayementRepository::class)]
class Payement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creatAt = null;

    #[ORM\ManyToOne(inversedBy: 'payements')]
    private ?DD $DD = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    #[ORM\Column]
    private ?float $montantVerser = null;

    #[ORM\ManyToOne(inversedBy: 'payements')]
    private ?DetteParVente $detteParVente = null;

    public function __construct(){
        $date = new \DateTimeImmutable();
        $this->creatAt = new \DateTimeImmutable($date->format('Y-m-d H:i'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeImmutable $creatAt): static
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getDD(): ?DD
    {
        return $this->DD;
    }

    public function setDD(?DD $DD): static
    {
        $this->DD = $DD;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMontantVerser(): ?float
    {
        return $this->montantVerser;
    }

    public function setMontantVerser(float $montantVerser): static
    {
        $this->montantVerser = $montantVerser;

        return $this;
    }

    public function getDetteParVente(): ?DetteParVente
    {
        return $this->detteParVente;
    }

    public function setDetteParVente(?DetteParVente $detteParVente): static
    {
        $this->detteParVente = $detteParVente;

        return $this;
    }
}
