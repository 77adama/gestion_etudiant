<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use App\Entity\Classe;
use App\DataFixtures\ClasseFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            for ($i=0; $i < 15; $i++) { 
              
        $rp = new Rp();
        $rp-> setNomComplet("mamadou ndong");
        $rp->setLoging("mamadou@gmail.com");
        $rp->setPassword("mamadou1");
        // $rp->setRole("rp");
        $manager->persist($rp);

        $classe = new Classe();
        $classe-> setLibelle("Dev-Web");
        $classe->setFliere("javascript");
        $classe->setNiveau("L1");
        $classe->setRp($rp);
        $manager->persist($classe);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
            }
    }
}
