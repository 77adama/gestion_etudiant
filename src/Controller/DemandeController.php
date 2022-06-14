<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeFormType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(DemandeRepository $demandeRep,PaginatorInterface $paginator,Request $request): Response
    {
        $demande=$paginator->paginate($demandeRep->findAll(),
        $request->query->getInt('page',1),3
    );
        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
            'demandes' =>$demande
        ]);
    }

    #[Route('/add-demande', name: 'addDemande')]
    #[Route('/demande/{id}/edit', name: 'editDemande')]
    public function form(Demande $demande=null , Request $request, EntityManagerInterface $em): Response
    {
        if(!$demande){
            $demande= new Demande();
        }
        $form = $this->createForm(DemandeFormType::class, $demande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setEtudiant($this->getUser());
            $em->persist($demande);
            $em->flush();
        }
        return $this->render('demande/addDemande.html.twig', [
            'form' =>$form->createView(),
            'editDemande' =>$demande->getId() !==null         
        ]);
    }
}
