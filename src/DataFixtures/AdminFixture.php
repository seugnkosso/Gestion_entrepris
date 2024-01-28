<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
;

class AdminFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $roles = ["ROLE_VENDEUR","ROLE_ADMIN"];
        foreach ($roles as $i => $role) {
            $user = new User();
            $user->setNomComplet(explode("_",$role)[1]);
            $user->setEmail(strtolower(explode("_",$role)[1])."@gmail.com");
            $user->setRoles([$role]);
            $user->setTelephone("770000000");
            $user->setIsArchived(false);
            $password = $this->hasher->hashPassword($user, 'lionkonkionjunior1');
            $user->setPassword($password);
            $manager->persist($user);
            $this->addReference("user".$i,$user);
        }
        $manager->flush();
    }
}
