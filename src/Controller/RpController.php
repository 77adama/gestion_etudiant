<?php

namespace App\Controller;

use App\Entity\Rp;
use App\Form\RpFormType;
use App\Repository\RpRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RpController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(RpRepository $rpRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $rp=$paginator->paginate($rpRepository->findAll(),
        $request->query->getInt('page',1),4
    
    );
        
        return $this->render('rp/index.html.twig', [
            'controller_name' => 'RpController',
            'rps' =>$rp,
        ]);
    }

    #[Route('/add-rp', name: 'addRp')]
    public function addRp(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $rp= new Rp();
        $form = $this->createForm(RpFormType::class, $rp);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rp->setPassword($hasher->hashPassword($rp, $rp->getPassword()));
            $em->persist($rp);
            $em->flush();
        }

        return $this->render('rp/addRp.html.twig', [
            'form' =>$form->createView()
        ]);
    }

}
