<?php

namespace App\Controller\clientController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


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
    #[Route('/profile-client', name: 'add_profile_client')]
    function CreateClientProfile(): Response
    {
        return $this->render('side/profileClient.html.twig');
    }
    #[Route('/profile-client', name: 'create_user_profile')]
    public function createUserProfile(Request $request): Response
    {
        // Get the submitted form data
        $name = $request->request->get('name');
        $lastName = $request->request->get('last_name');
        $service = $request->request->get('service');

        // Pass the data to the form template
        return $this->render('side/createUserProfile.html.twig', [
            'name' => $name,
            'last_name' => $lastName,
            'service' => $service,
        ]);
    }

}