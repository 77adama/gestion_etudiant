<?php

namespace App\DataFixtures;

use App\Entity\Ac;
use App\Entity\Rp;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 15; $i++) { 
        $rp= new Rp();
        $rp-> setNomComplet("mbaye fall");
        $rp->setLoging("mbaye@gmail.com");
        $rp->setPassword("mbaye1");
        $rp->setRole("rp");
        $manager->persist($rp);

        $ac = new Ac();
        $ac-> setNomComplet("dame samb");
        $ac->setLoging("dame@gmail.com");
        $ac->setPassword("dame1");
        $ac->setRole("ac");
        $ac->setRp($rp);
        $manager->persist($ac);

        $classe = new Classe();
        $classe-> setLibelle("Dev-Web");
        $classe->setFliere("javascript");
        $classe->setNiveau("L1");
        $classe->setRp($rp);
        $manager->persist($classe);

        $etudiant= new Etudiant();
        $etudiant-> setNomComplet("ablaye fall");
        $etudiant->setLoging("ablaye@gmail.com");
        $etudiant->setPassword("ablaye1");
        $etudiant->setMatricule("A21");
        $etudiant->setSexe("m");
        $etudiant->setAdresse("mermoz");
        $etudiant->setRole("etudiant");
        $manager->persist($etudiant);

        $anneescolaire = new AnneeScolaire();
        $anneescolaire-> setLibelle("2021/2022");
        $manager->persist($anneescolaire);

        $inscription = new Inscription();
        $inscription->setDate("15/05/2022");
        $inscription->setAc($ac);
        $inscription->setClasse($classe);
        $inscription->setEtudiant($etudiant);
        $inscription->setAnneeScolaire($anneescolaire);
        $manager->persist($inscription);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    }
}
