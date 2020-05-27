<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $auteur = new Auteur();
        
        // Set characteristics 
        $auteur->setNom("default");
        $auteur->setNationalite('default');

        $manager->persist($auteur);

        $auteur = new Auteur();

        $auteur->setNom('Faidutti');
        $auteur->setPrenom('Bruno');
        $auteur->setNationalite('France');

        $manager->persist($auteur);

        $manager->flush();
    }
}
