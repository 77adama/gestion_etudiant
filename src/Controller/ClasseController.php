<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseFormType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $classeRep,PaginatorInterface $paginator,Request $request): Response
    {
        $classe =$paginator->paginate($classeRep->findAll(),
        $request->query->getInt('page',1),5
    );
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes' => $classe
        ]);
    }

    #[Route('/add-classe', name: 'addClasse')]
    public function addClasse(Request $request, EntityManagerInterface $em): Response
    {
        $classe= new Classe();
        $form = $this->createForm(ClasseFormType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($classe);
            $em->flush();
        }
        return $this->render('classe/addClasse.html.twig', [
            'form' =>$form->createView()        
        ]);
    }
}
