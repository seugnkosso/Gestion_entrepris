<?php

namespace App\Entity;

use App\Repository\SuperviseurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperviseurRepository::class)]
class Superviseur extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->setRoles(['ROLE_SUPERVISEUR']);
    }
}
