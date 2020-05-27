<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class JeuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $jeu = new Jeu();
        $jeu->setTitre("King of Tokyo");
        $jeu->setJoueursMin(2);
        $jeu->setJoueursMax(6);
        $jeu->setDuree(30);
        $jeu->setAnnee(2011);

        $manager->persist($jeu);
        
        /*
        $jeu = new Jeu();
        $jeu->setTitre("Citadelles");
        $jeu->setJoueursMin(3);
        $jeu->setJoueursMax(7);
        $jeu->setDuree(60);
        $jeu->setAnnee(2000);

        $manager->persist($jeu);
        */
        
        $manager->flush();
    }
}
