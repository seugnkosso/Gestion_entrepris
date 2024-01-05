<?php

namespace App\Entity;

use App\Repository\DueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DueRepository::class)]
class Due extends DD
{
    public function __construct(){
        parent::__construct();
    }
}
