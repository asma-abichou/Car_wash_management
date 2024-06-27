<?php

namespace App\Controller;

use App\Entity\CarWashPoint;
use App\Form\CarWashPointType;
use App\Repository\CarWashPointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/customer')]
class CustomerController extends AbstractController
{

    #[Route('/home', name: 'customer_home_page')]
    function customerHomePage () : Response
    {
        return $this->render('customer/home.html.twig');

    }

    #[Route('/reservation', name: 'customer_reservation_page')]
    function bookNow () : Response
    {

        return $this->render('customer/bookNow.html.twig');

    }

}