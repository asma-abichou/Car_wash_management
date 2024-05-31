<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SideClientHomeController extends AbstractController
{
    #[Route('/home-client-side', name: 'client_home')]
    function clientHome(): Response
    {
        return $this->render('side/accueil.html.twig');
    }

}