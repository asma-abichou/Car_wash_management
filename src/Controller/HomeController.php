<?php

namespace App\Controller;


use App\Form\MyProfileFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'home_page')]
    #[IsGranted('ROLE_USER')]
    function home () : Response
    {
        return $this->render('template.html.twig');

    }

    #[Route('/profile', name: 'profile_page')]
    #[IsGranted('ROLE_USER')]
    function profile (Request $request) : Response
    {
        $user = $this->getUser();
        $form = $this->createForm(MyProfileFormType::class, $user);
        $form->handleRequest($request);
        return $this->render('profile/profile.html.twig', [
            'myProfileForm' => $form->createView(),
        ]);

    }

}