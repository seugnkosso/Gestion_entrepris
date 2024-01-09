<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type: "string")]
#[ORM\DiscriminatorMap(["user"=> User::class, "admin" => Admin::class,"vendeur"=>Vendeur::class,"superviseur"=>Superviseur::class])]  
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $nomComplet = null;

    #[ORM\Column(length: 9)]
    private ?string $telephone = null;

    #[ORM\Column]
    private ?bool $isArchived = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: VC::class)]
    private Collection $VC;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DetteParVente::class)]
    private Collection $detteParVentes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dette::class)]
    private Collection $dettes;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    public function __construct()
    {
        $this->VC = new ArrayCollection();
        $this->detteParVentes = new ArrayCollection();
        $this->dettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function isIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): static
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * @return Collection<int, VC>
     */
    public function getVC(): Collection
    {
        return $this->VC;
    }

    public function addVC(VC $vC): static
    {
        if (!$this->VC->contains($vC)) {
            $this->VC->add($vC);
            $vC->setUser($this);
        }

        return $this;
    }

    public function removeVC(VC $vC): static
    {
        if ($this->VC->removeElement($vC)) {
            // set the owning side to null (unless already changed)
            if ($vC->getUser() === $this) {
                $vC->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetteParVente>
     */
    public function getDetteParVentes(): Collection
    {
        return $this->detteParVentes;
    }

    public function addDetteParVente(DetteParVente $detteParVente): static
    {
        if (!$this->detteParVentes->contains($detteParVente)) {
            $this->detteParVentes->add($detteParVente);
            $detteParVente->setUser($this);
        }

        return $this;
    }

    public function removeDetteParVente(DetteParVente $detteParVente): static
    {
        if ($this->detteParVentes->removeElement($detteParVente)) {
            // set the owning side to null (unless already changed)
            if ($detteParVente->getUser() === $this) {
                $detteParVente->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dette>
     */
    public function getDettes(): Collection
    {
        return $this->dettes;
    }

    public function addDette(Dette $dette): static
    {
        if (!$this->dettes->contains($dette)) {
            $this->dettes->add($dette);
            $dette->setUser($this);
        }

        return $this;
    }

    public function removeDette(Dette $dette): static
    {
        if ($this->dettes->removeElement($dette)) {
            // set the owning side to null (unless already changed)
            if ($dette->getUser() === $this) {
                $dette->setUser(null);
            }
        }

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
