<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use Faker\Factory;
use App\DataFixtures\RpFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RpFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        

        // public function __construct(){
        //     $this->encoder=$encoder;
        // }
        $rp= new Rp();
        $rp-> setNomComplet($faker->name());
        $rp->setLoging($faker->email());
        $rp->setPassword($faker->password());
        // $rp->setRole("rp");
        $manager->persist($rp);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
