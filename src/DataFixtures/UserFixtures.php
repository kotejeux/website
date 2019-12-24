<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("kotejeux");
        $user->setEmail("kotejeux@gmail.com");
        $user->setRoles(["ROLE_ADMIN", 'ROLE_USER']);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'kej'
        ));

        $manager->persist($user);

        $user = new User();
        $user->setUsername("jean");
        $user->setemail("jeanvanneste@gmail.com");
        $user->setRoles(["ROLE_USER"]);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'hello'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
