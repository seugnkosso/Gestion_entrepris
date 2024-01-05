<?php

namespace App\Entity;

use App\Repository\DetailVCRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailVCRepository::class)]
class DetailVC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixVente = null;

    #[ORM\Column]
    private ?int $qteVente = null;

    #[ORM\ManyToOne(inversedBy: 'detailVc')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VC $vC = null;

    #[ORM\ManyToOne(inversedBy: 'detailVc')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'detaillDette')]
    private ?DetteParVente $detteParVente = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): static
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getQteVente(): ?int
    {
        return $this->qteVente;
    }

    public function setQteVente(int $qteVente): static
    {
        $this->qteVente = $qteVente;

        return $this;
    }

    public function getVC(): ?VC
    {
        return $this->vC;
    }

    public function setVC(?VC $vC): static
    {
        $this->vC = $vC;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

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
