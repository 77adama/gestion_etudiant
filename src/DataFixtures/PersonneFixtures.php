<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\PersonneFixtures;

class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $personne= new Personne(); 
        // $personne-> setNomComplet("nogaye diop");
        // $personne->setRole("attache");
        // $manager->persist($personne);



        $manager->flush();
    }
}
