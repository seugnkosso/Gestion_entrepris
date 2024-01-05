<?php

namespace App\Entity;

use App\Repository\DetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetteRepository::class)]
class Dette extends DD
{
    #[ORM\ManyToOne(inversedBy: 'dettes')]
    private ?User $user = null;

    public function __construct(){
        parent::__construct();
        $this->setTypeDD('dus');    
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
}
