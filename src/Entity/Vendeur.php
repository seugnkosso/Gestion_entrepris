<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendeurRepository::class)]
class Vendeur extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->setRoles(['ROLE_VENDEUR']);
    }
}
