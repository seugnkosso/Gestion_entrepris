<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande extends VC
{
    public function __construct(){
        parent::__construct();
        $this->setNumero("COMMANDE_N°".$this->getCreatAt()->format("i:s")."_".$this->getCreatAt()->format("y-m-d H:i"));
    }
}
