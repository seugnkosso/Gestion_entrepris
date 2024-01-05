<?php

namespace App\Entity;

use App\Repository\DetteParVenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetteParVenteRepository::class)]
class DetteParVente extends DD
{

    #[ORM\Column]
    private ?float $benefice = null;

    #[ORM\OneToMany(mappedBy: 'detteParVente', targetEntity: DetailVc::class)]
    private Collection $detaillDette;

    #[ORM\ManyToOne(inversedBy: 'detteParVentes')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $benefComplet = false;

    public function __construct()
    {
        parent::__construct();
        $this->detaillDette = new ArrayCollection();
        $this->setTypeDD("detteParVente");
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

    /**
     * @return Collection<int, DetailVc>
     */
    public function getDetaillDette(): Collection
    {
        return $this->detaillDette;
    }

    public function addDetaillDette(DetailVc $detaillDette): static
    {
        if (!$this->detaillDette->contains($detaillDette)) {
            $this->detaillDette->add($detaillDette);
            $detaillDette->setDetteParVente($this);
        }

        return $this;
    }

    public function removeDetaillDette(DetailVc $detaillDette): static
    {
        if ($this->detaillDette->removeElement($detaillDette)) {
            // set the owning side to null (unless already changed)
            if ($detaillDette->getDetteParVente() === $this) {
                $detaillDette->setDetteParVente(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isBenefComplet(): ?bool
    {
        return $this->benefComplet;
    }

    public function setBenefComplet(bool $benefComplet): static
    {
        $this->benefComplet = $benefComplet;

        return $this;
    }

}
