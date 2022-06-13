<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Form\EtudiantFormType;
use App\Repository\AcRepository;
use App\Repository\RpRepository;
use App\Form\InscriEtudiantFormType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    #[Route('/inscrire-etudiant', name: 'inscrEtudiant')]
    public function addEtudiant(Request $request,AcRepository $acRep,ClasseRepository $classeRep,AnneeScolaireRepository $annRepository, EntityManagerInterface $em,UserPasswordHasherInterface $hasher ): Response
    {
        $etudiant= new Etudiant();
        $etudiant->setRoles(["ROLE_ETUDANT"]);
        $inscription= new Inscription();
        // $form = $this->createForm(InscriEtudiantFormType::class, $etudiant);
        $form = $this->createFormBuilder($etudiant)
                ->add('nomComplet')
                ->add('email')
                ->add('password')
                ->add('matricule')
                ->add('sexe')
                ->add('adresse')
                // ->add('date')
                // ->add('classe')
                // ->add('anneescolaire')
                // ->add('ac')
                // ->add('etudiant')
                -> getForm();
        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $anneeInscr= $annRepository->find($request->get("annee"));
            $acInscr=$acRep->find($request->get("ac_id"));
            $classeInscr=$classeRep->find($request->get("classe"));
            $em->persist($etudiant);
            $inscription->setEtudiant($etudiant);
            // $inscription->setDate($date);   setAc_id($_SESSION["user-connect"]->id);            
            $inscription->setClasse($classeInscr);
            $inscription->setAnneescolaire($anneeInscr);
            $inscription->setAc($acInscr);
            $etudiant->setPassword($hasher->hashPassword($etudiant, $etudiant->getPassword()));
            $em->persist($inscription);
            $em->flush();
        }
        $anneescolaire= $annRepository->findAll();
        $ac=$acRep->findAll();
        $classe=$classeRep->findAll();
        return $this->render('inscription/addEtudiant.html.twig', [
            'form' =>$form->createView(),
            'annees'=>$anneescolaire,
            'acs' =>$ac,
            'classes'=>$classe,
        ]);
    }

    // #[Route('/inscrire-etudiant', name: 'inscrEtudiant')]
    // public function addEtudiant(Request $request): Response
    // {
    //     $etudiant= new Etudiant();
    //     // $etudiant->setRole(["ROLE_ETUDANT"]);
    //     // $idRp=RpRepository::setId($rp);
    //     // dd($idRp);
    //     $form = $this->createForm(InscriEtudiantFormType::class, $etudiant);
    //     $form->handleRequest($request);
    //     dd($form);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $etudiant->setPassword($hasher->hashPassword($etudiant, $etudiant->getPassword()));
    //         $em->persist($etudiant);
    //         $em->flush();
    //     }

    //     return $this->render('inscription/addEtudiant.html.twig', [
    //         'form' =>$form->createView()
    //     ]);
    // }
}
