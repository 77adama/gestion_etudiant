<?php

namespace App\DataFixtures;

use App\Entity\Ac;
use App\Entity\Rp;
use Faker\Factory;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ProfesseurFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=0; $i <20 ; $i++) { 
           
        $rp= new Rp();
        $grade=["ingenieur","docteur","technicien","informaticien","chimiste"];
        $rp-> setNomComplet($faker->name());
        $rp->setLoging($faker->email());
        $rp->setPassword($faker->password());
        // $rp->setRole("rp");
        $manager->persist($rp);

        $prof = new Professeur();
        $pos=rand(0,3);
        $prof-> setNomComplet($faker->name());
        $prof->setGrade($grade[$pos]);
        // $prof->setRole("prof");
        $prof->setRp($rp);
        $manager->persist($prof);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
        }

}
