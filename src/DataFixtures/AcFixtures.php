<?php

namespace App\DataFixtures;

use App\Entity\Ac;
use App\Entity\Rp;
use Faker\Factory;
use App\DataFixtures\AcFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AcFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
            for ($i=0; $i < 15; $i++) { 
            
        $rp= new Rp();
        $rp-> setNomComplet($faker->name());
        $rp->setLoging($faker->email());
        $rp->setPassword($faker->password());
        // $rp->setRole("rp");
        $manager->persist($rp);

        $ac = new Ac();
        $ac-> setNomComplet($faker->name());
        $ac->setLoging($faker->email());
        $ac->setPassword($faker->password());
        // $ac->setRole("ac");
        $ac->setRp($rp);
        $manager->persist($ac);
       

        $manager->flush();
    }

    }
}
