<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente extends VC
{
    public function __construct(){
        parent::__construct();
        $this->setNumero("VENTE_N°".$this->getCreatAt()->format("i:s")."_".$this->getCreatAt()->format("y-m-d H:i"));
    }
}
