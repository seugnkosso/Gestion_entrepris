<?php

namespace App\Entity;

use App\Repository\VCRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VCRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type: "string")]
#[ORM\DiscriminatorMap(["vc"=> VC::class, "vente" => Vente::class,"commande"=>Commande::class])]  
class VC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $creatAt = null;

    #[ORM\Column]
    protected ?float $total = null;

    #[ORM\Column(length: 255)]
    protected ?string $client = null;

    #[ORM\Column(length: 255)]
    protected ?string $numero = null;

    #[ORM\ManyToOne(inversedBy: 'VC')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'vC', targetEntity: DetailVC::class)]
    protected Collection $detailVc;

    #[ORM\ManyToOne(inversedBy: 'vc')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Point $point = null;

    public function __construct(){
        $this->creatAt = new \DateTimeImmutable();
        $this->detailVc = new ArrayCollection();
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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

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
            $detailVc->setVC($this);
        }

        return $this;
    }

    public function removeDetailVc(DetailVC $detailVc): static
    {
        if ($this->detailVc->removeElement($detailVc)) {
            // set the owning side to null (unless already changed)
            if ($detailVc->getVC() === $this) {
                $detailVc->setVC(null);
            }
        }

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
