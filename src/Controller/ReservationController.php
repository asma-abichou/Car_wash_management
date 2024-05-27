<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservations', name: 'show_list_reservations')]
    function home () : Response
    {
        return $this->render('reservations/listReservation.html.twig');

    }

}