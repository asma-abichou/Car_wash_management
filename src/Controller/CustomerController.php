<?php

namespace App\Controller;

use App\Entity\CarWashPoint;
use App\Form\CarWashPointType;
use App\Repository\CarWashPointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/customer')]
class CustomerController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }


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



   /* #[Route('/api/nearby-wash-cars', name: 'nearby_wash_cars', methods: ['GET'])]
    public function getNearbyWashCars(Request $request, CarWashPointRepository $carWashPointRepository): JsonResponse
    {
        $lat = $request->query->get('lat');
        $lon = $request->query->get('lon');

        if ($lat === null || $lon === null) {
            return new JsonResponse(['error' => 'Latitude and longitude are required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Assuming you have a method in your repository to find nearby car wash points
        $nearbyCarWashPoints = $carWashPointRepository->findNearby($lat, $lon);

        return new JsonResponse($nearbyCarWashPoints);
    }*/
}