<?php

namespace App\Entity;

use App\Repository\DDRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DDRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type: "string")]
#[ORM\DiscriminatorMap(["due"=> Due::class, "dette" => Dette::class,"detteParVente" => DetteParVente::class])]  
class DD
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message : " {{label}} obligatoire")]
    private ?string $libelle = null;

    #[ORM\Column]
    #[Assert\NotBlank(message : " {{label}} obligatoire")]
    private ?\DateTimeImmutable $creatAt = null;

    #[ORM\Column]
    #[Assert\NotBlank(message : " {{label}} obligatoire")]
    private ?float $montantTotal = null;

    #[ORM\Column]
    private ?float $montantRestant = null;

    #[ORM\Column]
    private ?float $montantDonnee = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message : " {{label}} obligatoire")]
    private ?string $client = null;

    #[ORM\OneToMany(mappedBy: 'DD', targetEntity: Payement::class)]
    private Collection $payements;

    #[ORM\Column(length: 10)]
    private ?string $typeDD = null;

    #[ORM\ManyToOne(inversedBy: 'dd')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Point $point = null;

    public function __construct(){
        $date = new \DateTimeImmutable();
        $this->creatAt = new \DateTimeImmutable($date->format('Y-m-d'));
        $this->payements = new ArrayCollection();
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

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeImmutable $creatAt): static
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(float $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getMontantRestant(): ?float
    {
        return $this->montantRestant;
    }

    public function setMontantRestant(float $montantRestant): static
    {
        $this->montantRestant = $montantRestant;

        return $this;
    }

    public function getMontantDonnee(): ?float
    {
        return $this->montantDonnee;
    }

    public function setMontantDonnee(float $montantDonnee): static
    {
        $this->montantDonnee = $montantDonnee;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Payement>
     */
    public function getPayements(): Collection
    {
        return $this->payements;
    }

    public function addPayement(Payement $payement): static
    {
        if (!$this->payements->contains($payement)) {
            $this->payements->add($payement);
            $payement->setDD($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): static
    {
        if ($this->payements->removeElement($payement)) {
            // set the owning side to null (unless already changed)
            if ($payement->getDD() === $this) {
                $payement->setDD(null);
            }
        }

        return $this;
    }

    public function getTypeDD(): ?string
    {
        return $this->typeDD;
    }

    public function setTypeDD(string $typeDD): static
    {
        $this->typeDD = $typeDD;

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
