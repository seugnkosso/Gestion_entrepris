<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,unique: true)]
    #[Assert\Unique]
    private ?string $detail = null;

    #[ORM\Column]
    private ?int $qte = null;

    #[ORM\Column]
    private ?float $prixAchat = null;

    #[ORM\Column]
    private ?float $prixVenteFix = null;

    #[ORM\Column]
    private ?float $prixVenteMin = null;

    #[ORM\Column(length: 50)]
    private ?string $categorie = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: DetailVC::class)]
    private Collection $detailVc;

    public function __construct()
    {
        $this->detailVc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): static
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getPrixVenteFix(): ?float
    {
        return $this->prixVenteFix;
    }

    public function setPrixVenteFix(float $prixVenteFix): static
    {
        $this->prixVenteFix = $prixVenteFix;

        return $this;
    }

    public function getPrixVenteMin(): ?float
    {
        return $this->prixVenteMin;
    }

    public function setPrixVenteMin(float $prixVenteMin): static
    {
        $this->prixVenteMin = $prixVenteMin;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, DetailVC>
     */
    public function getDetailVc(): Collection
    {
        return $this->detailVc;
    }

    public function addDetailVc(DetailVC $detailVc): static
    {
        if (!$this->detailVc->contains($detailVc)) {
            $this->detailVc->add($detailVc);
            $detailVc->setProduit($this);
        }

        return $this;
    }

    public function removeDetailVc(DetailVC $detailVc): static
    {
        if ($this->detailVc->removeElement($detailVc)) {
            // set the owning side to null (unless already changed)
            if ($detailVc->getProduit() === $this) {
                $detailVc->setProduit(null);
            }
        }

        return $this;
    }
}
