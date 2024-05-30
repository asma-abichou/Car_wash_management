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

class CarWashController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }
    #[Route('/wash-point', name: 'car_wash_point_page')]
    function washPointList () : Response
    {
        return $this->render('WashCarPoint/carWashPoint.html.twig');

    }
    #[Route('/car-wash-point/add', name: 'car_wash_add')]
    function addWashPoint (Request $request, CarWashPointRepository $carWashPointRepository) : Response
    {
        $carWashPoint = new CarWashPoint();
        $form = $this->createForm(CarWashPointType::class, $carWashPoint);
        $form->handleRequest($request);
       // dd("hi");
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($carWashPoint);
            $this->entityManager->flush();
            return $this->redirectToRoute('car_wash_add');
        }
        $washCarPoints = $carWashPointRepository->findAll();

        return $this->render('WashCarPoint/carWashPoint.html.twig', [
            'form' => $form->createView(),
            'washCarPoints' => $washCarPoints,
        ]);

    }
    #[Route('/car-wash-point/{id}/delete', name: 'car_wash_delete')]
    function deleteWashPoint( CarWashPoint $carWashPoint, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($carWashPoint);
        $entityManager->flush();

        return $this->redirectToRoute('car_wash_add');
    }


}