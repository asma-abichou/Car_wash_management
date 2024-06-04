<?php

namespace App\Controller\clientController;

use App\Entity\Customer;
use App\Form\CustomerProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CustomerController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }
    #[Route('/customer/create', name: 'customer_create')]
    public function create(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerProfileType::class, $customer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($customer);
            $this->entityManager->flush();

            return $this->redirectToRoute('customer_create');
        }

        return $this->render('side/profileClient.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}