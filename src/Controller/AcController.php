<?php

namespace App\Controller;

use App\Entity\Ac;
use App\Form\AcFormType;
use App\Repository\AcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(AcRepository $acRep, PaginatorInterface $paginator,Request $request): Response
    {
        $ac=$paginator->paginate($acRep->findAll(),
        $request->query->getInt('page',1),4
    );
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
            'acs'=>$ac,
        ]);
    }

    #[Route('/add-ac', name: 'addAc')]
    public function addAc(Request $request, EntityManagerInterface $em): Response
    {
        $ac= new Ac();
        $form = $this->createForm(AcFormType::class, $ac);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ac);
            $em->flush();
        }

        return $this->render('ac/addAc.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
