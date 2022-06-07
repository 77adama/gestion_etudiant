<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use App\Entity\Demande;
use App\Entity\Etudiant;
use App\DataFixtures\DemandeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class DemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 15; $i++) { 
          
        $matricule=["mat","A42","A43","A44","A45","A46","A47"];
        $sexe=["m","f","m","m","f","m","m","f","f","m"];
        $libelle=[
            "annuller","suspendre","bloquer","annuller","retirerer"
        ] ;
        $motif=[
            "pas de motif","occuper","abandoner","occuper","abandoner",""
        ] ;
        $adresse=[
            "guediawaye","dakar","thies","tambah","logar","pikine"
        ] ;
        // $product = new Product();
        // $manager->persist($product); 
        $etudiant= new Etudiant();
        $pos=rand(0,3);
        $etudiant-> setNomComplet($faker->name());
        $etudiant->setLoging($faker->email());
        $etudiant->setPassword($faker->password());
        $etudiant->setMatricule($matricule[$pos]);
        $etudiant->setSexe($sexe[$pos]);
        $etudiant->setAdresse($adresse[$pos]);
        // $etudiant->setRole("etudiant");
        $manager->persist($etudiant);

        $rp = new Rp();
        $rp-> setNomComplet($faker->name());
        $rp->setLoging($faker->email());
        $rp->setPassword($faker->password());
        // $rp->setRole("rp");
        $manager->persist($rp);

        $demande = new Demande(); 
        $demande-> setLibelle($libelle[$pos]);
        $demande->setMotif($motif[$pos]);
        $demande->setEtudiant($etudiant);
        $demande->setRp($rp);
        $manager->persist($demande);

        $manager->flush();
    }
    }
}
