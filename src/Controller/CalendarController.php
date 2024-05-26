<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarController extends AbstractController
{
    #[Route('/show', name: 'calendar_page')]
    function home () : Response
    {
        return $this->render('calendar/calendar.html.twig');

    }

}