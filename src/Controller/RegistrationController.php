<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CustomerProfileType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/owner/register', name: 'app_register')]
    public function registerOwner(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistrationFormType::class, new User());
        return $this->register($request, $userPasswordHasher, $entityManager, $form, 'ROLE_OWNER');
    }

    #[Route('/customer/register', name: 'register_customer')]
    public function registerCustomer(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerProfileType::class, new User());
        return $this->register($request, $userPasswordHasher, $entityManager, $form, 'ROLE_CUSTOMER');
    }

    private function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, $form, $role)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user = $form->getData();
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            // Set the user role
            $user->setRoles([$role]);

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            if ($role === 'ROLE_OWNER') {
                return $this->redirectToRoute('app_login_owner');
            } elseif ($role === 'ROLE_CUSTOMER') {
                return $this->redirectToRoute('app_login_customer');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'role' => $role,
        ]);
    }
}
