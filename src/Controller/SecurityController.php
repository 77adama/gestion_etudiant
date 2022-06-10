<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    // #[Route('/security', name: 'app_security')]
    // public function index(): Response
    // {
    //     return $this->render('security/index.html.twig', [
    //         'controller_name' => 'SecurityController',
    //     ]);
    // }
    // #[Route('/security/user', name: 'app_security')]
    // public function connexion (Request $request): Response
    // {
    //     $user = new User();
    //     $form = $this->createForm(LoginType::class, $user);
    //     $form->handleRequest($request);
    //     return $this->render('security/index.html.twig', [
    //         'controller_name' => 'SecurityController',
    //         'form'=>$form->createView(),
    //     ]);
    // }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/home', name: 'app_home')]
    public function home(): Response
    {
      
        return $this->render('security/home.html.twig');
    }
}
