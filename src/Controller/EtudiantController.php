<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantFormType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $etudiantRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $etudiant= $paginator->paginate ($etudiantRepository->findAll(),
        $request->query->getInt('page',1),1
        );
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'etudiants' =>$etudiant
        ]);
    }
    #[Route('/add-etudiant', name: 'addEtudiant')]
    public function addEtudiant(Request $request, EntityManagerInterface $em): Response
    {
        $etudiant= new Etudiant();
        $form = $this->createForm(EtudiantFormType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($etudiant);
            $em->flush();
        }

        return $this->render('etudiant/addEtudiant.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
