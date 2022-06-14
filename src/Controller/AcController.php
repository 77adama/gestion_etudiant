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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(AcRepository $acRep, PaginatorInterface $paginator,Request $request): Response
    {
        $ac=$paginator->paginate($acRep->findAll(),
        $request->query->getInt('page',1),5
    );
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
            'acs'=>$ac,
        ]);
    }

    #[Route('/add-ac', name: 'addAc')]
    public function addAc(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $ac= new Ac();
        $ac->setRoles(["ROLE_AC"]);
        $form = $this->createForm(AcFormType::class, $ac);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ac->setRp($this->getUser());
            $ac->setPassword($hasher->hashPassword($ac, $ac->getPassword()));
            $em->persist($ac);
            $em->flush();
        }

        return $this->render('ac/addAc.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
