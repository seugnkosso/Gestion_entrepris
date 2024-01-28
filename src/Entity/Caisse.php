<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaisseRepository::class)]
class Caisse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatAt = null;

    #[ORM\Column]
    private ?float $TotalFrais = null;

    #[ORM\Column]
    private ?float $totalVente = null;

    #[ORM\Column]
    private ?float $totalDettePayer = null;

    #[ORM\Column]
    private ?float $TotalDusPayer = null;

    #[ORM\Column]
    private ?float $TotalCommande = null;

    #[ORM\Column]
    private ?float $benefice = null;

    #[ORM\ManyToOne(inversedBy: 'caisse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Point $point = null;

    public function __construct(){
        $date = new \DateTimeImmutable();
        $this->CreatAt = new \DateTimeImmutable($date->format('Y-m-d H:i'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->CreatAt;
    }

    public function setCreatAt(\DateTimeImmutable $CreatAt): static
    {
        $this->CreatAt = $CreatAt;

        return $this;
    }

    public function getTotalFrais(): ?float
    {
        return $this->TotalFrais;
    }

    public function setTotalFrais(float $TotalFrais): static
    {
        $this->TotalFrais = $TotalFrais;

        return $this;
    }

    public function getTotalVente(): ?float
    {
        return $this->totalVente;
    }

    public function setTotalVente(float $totalVente): static
    {
        $this->totalVente = $totalVente;

        return $this;
    }

    public function getTotalDettePayer(): ?float
    {
        return $this->totalDettePayer;
    }

    public function setTotalDettePayer(float $totalDettePayer): static
    {
        $this->totalDettePayer = $totalDettePayer;

        return $this;
    }

    public function getTotalDusPayer(): ?float
    {
        return $this->TotalDusPayer;
    }

    public function setTotalDusPayer(float $TotalDusPayer): static
    {
        $this->TotalDusPayer = $TotalDusPayer;

        return $this;
    }

    public function getTotalCommande(): ?float
    {
        return $this->TotalCommande;
    }

    public function setTotalCommande(float $TotalCommande): static
    {
        $this->TotalCommande = $TotalCommande;

        return $this;
    }

    public function getBenefice(): ?float
    {
        return $this->benefice;
    }

    public function setBenefice(float $benefice): static
    {
        $this->benefice = $benefice;

        return $this;
    }

    public function getPoint(): ?Point
    {
        return $this->point;
    }

    public function setPoint(?Point $point): static
    {
        $this->point = $point;

        return $this;
    }
}
