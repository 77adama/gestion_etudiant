<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=2019; $i <2022 ; $i++) { 
            $anneescolaire = new AnneeScolaire();
            $annee= $i."-".($i+1);
            $anneescolaire-> setLibelle($annee);
            $manager->persist($anneescolaire);
            // $product = new Product();
            // $manager->persist($product);
    
            $manager->flush();
         }

    }
}
