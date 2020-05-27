<?php

namespace App\DataFixtures;

use App\Entity\Editeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EditeurFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $editeur = new Editeur;
        $editeur->setName("Millenim");
        $editeur->setNationalite("France");
        
        $manager->persist($editeur);

        $manager->flush();
    }
}
