<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurFormType;
use App\Controller\ProfesseurController;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $professeurRep,PaginatorInterface $paginator,Request $request): Response
    {

        $professeur=$paginator->paginate($professeurRep->findAll(),
        $request->query->getInt('page',1),4
    );
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'professeurs' => $professeur,
        ]);
    }

    #[Route('/add-professeur', name: 'addprofesseur')]
    public function addProfesseur(Request $request, EntityManagerInterface $em): Response
    {
        $professeur= new Professeur();
        $form = $this->createForm(ProfesseurFormType::class, $professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($professeur);
            $em->flush();
        }

        return $this->render('professeur/addProfesseur.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
