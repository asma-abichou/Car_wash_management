<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CustomerProfileType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }
    #[Route('/owner/register', name: 'app_register_owner')]
    public function registerOwner(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(RegistrationFormType::class, new User());
        return $this->register($request, $userPasswordHasher, $form, 'ROLE_OWNER', 'registration/register.html.twig');
    }

    #[Route('/customer/register', name: 'app_register_customer')]
    public function registerCustomer(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(CustomerProfileType::class, new User());
        return $this->register($request, $userPasswordHasher, $form, 'ROLE_CUSTOMER', 'side/profileClient.html.twig');
    }

    private function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                              $form, $role, $template): Response
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user = $form->getData();
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $form->get('password')->getData())
            );

            // Set the user role
            $user->setRoles([$role]);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Inscription réussi!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render($template, [
            'registrationForm' => $form->createView(),
            'role' => $role,
        ]);

    }
}
