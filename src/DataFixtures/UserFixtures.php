<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail("thomas.piard.etudes@gmail.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
            $userAdmin,
            'admin'
        ));
        $manager->persist($userAdmin);

        $visiteur = new User();
        $visiteur->setEmail("Grimskellington8@gmail.com");
        $visiteur->setRoles(["ROLE_VISITEUR"]);
        $visiteur->setPassword($this->passwordEncoder->encodePassword(
            $visiteur,
            'visiteur'
        ));
        $manager->persist($visiteur);

        $manager->flush();
    }
}
