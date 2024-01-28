<?php

namespace App\Entity;

use App\Repository\PointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointRepository::class)]
class Point
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50,unique: true)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'points')]
    private Collection $user;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: Produit::class)]
    private Collection $produit;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: Frais::class)]
    private Collection $frais;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: DD::class)]
    private Collection $dd;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: VC::class)]
    private Collection $vc;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: Caisse::class)]
    private Collection $caisse;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->produit = new ArrayCollection();
        $this->frais = new ArrayCollection();
        $this->dd = new ArrayCollection();
        $this->vc = new ArrayCollection();
        $this->caisse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
            $produit->setPoint($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getPoint() === $this) {
                $produit->setPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Frais>
     */
    public function getFrais(): Collection
    {
        return $this->frais;
    }

    public function addFrai(Frais $frai): static
    {
        if (!$this->frais->contains($frai)) {
            $this->frais->add($frai);
            $frai->setPoint($this);
        }

        return $this;
    }

    public function removeFrai(Frais $frai): static
    {
        if ($this->frais->removeElement($frai)) {
            // set the owning side to null (unless already changed)
            if ($frai->getPoint() === $this) {
                $frai->setPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DD>
     */
    public function getDd(): Collection
    {
        return $this->dd;
    }

    public function addDd(DD $dd): static
    {
        if (!$this->dd->contains($dd)) {
            $this->dd->add($dd);
            $dd->setPoint($this);
        }

        return $this;
    }

    public function removeDd(DD $dd): static
    {
        if ($this->dd->removeElement($dd)) {
            // set the owning side to null (unless already changed)
            if ($dd->getPoint() === $this) {
                $dd->setPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VC>
     */
    public function getVc(): Collection
    {
        return $this->vc;
    }

    public function addVc(VC $vc): static
    {
        if (!$this->vc->contains($vc)) {
            $this->vc->add($vc);
            $vc->setPoint($this);
        }

        return $this;
    }

    public function removeVc(VC $vc): static
    {
        if ($this->vc->removeElement($vc)) {
            // set the owning side to null (unless already changed)
            if ($vc->getPoint() === $this) {
                $vc->setPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Caisse>
     */
    public function getCaisse(): Collection
    {
        return $this->caisse;
    }

    public function addCaisse(Caisse $caisse): static
    {
        if (!$this->caisse->contains($caisse)) {
            $this->caisse->add($caisse);
            $caisse->setPoint($this);
        }

        return $this;
    }

    public function removeCaisse(Caisse $caisse): static
    {
        if ($this->caisse->removeElement($caisse)) {
            // set the owning side to null (unless already changed)
            if ($caisse->getPoint() === $this) {
                $caisse->setPoint(null);
            }
        }

        return $this;
    }
}
