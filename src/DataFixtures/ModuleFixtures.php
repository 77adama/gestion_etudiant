<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use Faker\Factory;
use App\Entity\Module;
use App\DataFixtures\ModuleFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create();
        
            for ($i=0; $i < 15; $i++) { 
            $libelle=[
                "algo","math","javascript","java"
            ]   ;
        $rp= new Rp();
        $rp-> setNomComplet($faker->name());
        $rp->setLoging($faker->email());
        $rp->setPassword($faker->password());
        // $rp->setRole("admin");
        $manager->persist($rp);

        $module = new Module();
        $pos=rand(0,3);
        $module->setLibelle($libelle[$pos]);
        $module->setRp($rp);
        $manager->persist($module);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    }
}
