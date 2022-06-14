<?php

namespace App\Controller;

use App\Entity\Rp;
use App\Entity\Module;
use App\Form\ModuleFormType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repository,PaginatorInterface $paginator,Request $request): Response
    {
        $module=$paginator->paginate($repository->findAll(),
        $request->query->getInt('page',1),3
    ); 
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
            'modules' =>$module,
        ]);
    }

    #[Route('/add-module', name: 'addModule')]
    #[Route('/module/{id}/edit', name: 'editModule')]
    public function form(module $module=null, Request $request, EntityManagerInterface $em): Response
    {
        if(!$module){
            $module= new Module();
        }
        
        $form = $this->createForm(ModuleFormType::class, $module);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $module->setRp($this->getUser());
            $em->persist($module);
            $em->flush();
        }
        return $this->render('module/addModule.html.twig', [
            'form' =>$form->createView(),
            'editModule' =>$module->getId() !==null      
        ]);
    }

            #[Route('RP/module/delete/{id}', name: 'module_delete')]
        public function delete(Module $module,EntityManagerInterface $em): Response
        {
        $em->remove($module);
        $em->flush();
        return $this->redirectToRoute('app_module');
        }

}
