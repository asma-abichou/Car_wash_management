<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted('ROLE_USER')]
class SideClientHomeController extends AbstractController
{
    #[Route('/home-client-side', name: 'client_home')]
    function clientHome(): Response
    {
        return $this->render('side/accueil.html.twig');
    }
  #[Route('/nearest-car-wash', name: 'nearest_car_wash')]
    function ListNearestCarWash(): Response
    {
        return $this->render('side/accueil.html.twig');
    }

}