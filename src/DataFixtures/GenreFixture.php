<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GenreFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genre = new Genre();
        $genre->setGenre('Strategie');
        $manager->persist($genre);

        $manager->flush();
    }
}
