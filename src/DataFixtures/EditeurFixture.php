<?php

namespace App\DataFixtures;

use App\Entity\Editeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EditeurFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $editeur = new Editeur();
        $editeur->setName('default');
        $editeur->setNationalite('default');
        $manager->persist($editeur);

        $manager->flush();
    }
}
