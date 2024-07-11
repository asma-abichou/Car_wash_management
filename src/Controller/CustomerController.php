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
    #[Route('/carwashes', name: 'carwashes', methods: 'GET')]
    public function getCarWashes(CarWashPointRepository $carWashPointRepository): JsonResponse
    {
        $userLatitude = 35.77799; // Replace with the actual latitude of the user's location
        $userLongitude = 10.82617; // Replace with the actual longitude of the user's location
        $maxDistance = 20; // Maximum distance in kilometers

        $carWashes = $carWashPointRepository->findAll();
        $data = [];

        foreach ($carWashes as $carWash) {
            $carWashLatitude = $carWash->getLatitude();
            $carWashLongitude = $carWash->getLongitude();
            $distance = $this->calculateDistance($userLatitude, $userLongitude, $carWashLatitude, $carWashLongitude);

            if ($distance <= $maxDistance) {
                $data[] = [
                    'name' => $carWash->getName(),
                    'latitude' => $carWash->getLatitude(),
                    'longitude' => $carWash->getLongitude(),
                    'distance' => $distance,
                ];
            }
        }

        return new JsonResponse($data);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // Radius of the earth in kilometers

        $latDistance = deg2rad($lat2 - $lat1);
        $lonDistance = deg2rad($lon2 - $lon1);

        $a = sin($latDistance / 2) * sin($latDistance / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDistance / 2) * sin($lonDistance / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
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