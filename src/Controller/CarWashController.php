<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarWashController extends AbstractController
{
    #[Route('/wash', name: 'car_wash_point_page')]
    function home () : Response
    {
        return $this->render('WashCarPoint/carWashPoint.html.twig');

    }

}