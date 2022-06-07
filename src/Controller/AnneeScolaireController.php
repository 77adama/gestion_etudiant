<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Form\AnneeScolaireFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnneeScolaireController extends AbstractController
{
    #[Route('/annee/scolaire', name: 'app_annee_scolaire')]
    public function index(AnneeScolaireRepository $repository,PaginatorInterface $paginator,Request $request) : Response
    {
        $annee_scolaire=$paginator->paginate($repository->findAll(),
        $request->query->getInt('page',1),5
    );
        return $this->render('annee_scolaire/index.html.twig', [
            'controller_name' => 'AnneeScolaireController',
            'annee_scolaires' =>$annee_scolaire,
        ]);
    }

    #[Route('/add-annee-scolaire', name: 'addAnneeScolaire')]
    #[Route('/{id}/edit', name: 'editAnneeScolaire')]
    public function form(AnneeScolaire $anneeScolaire=null , Request $request, EntityManagerInterface $em): Response
    {
        if(!$anneeScolaire){
            $anneeScolaire= new AnneeScolaire();
        }
        $form = $this->createForm(AnneeScolaireFormType::class, $anneeScolaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($anneeScolaire);
            $em->flush();
        }
        return $this->render('annee_scolaire/addAnneeScolaire.html.twig', [
            'form' =>$form->createView(),
            'editAnneeScolaire' =>$anneeScolaire->getId() !==null         
        ]);
    }
}
