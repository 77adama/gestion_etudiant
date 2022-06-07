<?php

namespace App\Controller;

use App\Repository\PersonneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function index(PersonneRepository $personneRep,PaginatorInterface $paginator,Request $request): Response
    {

        $personne =$paginator->paginate($personneRep->findAll(),
        $request->query->getInt('page',1),4
    );

        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes' =>$personne
        ]);
    }
}
