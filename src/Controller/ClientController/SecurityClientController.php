<?php

namespace App\Controller\ClientController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityClientController extends AbstractController
{
    #[Route(path: '/customer/login', name: 'login_customer')]
    public function loginClient(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
            // Check user role and redirect
            $user = $this->getUser();
            return $this->redirectToRoute('client_home');

        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login-Customer.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
            ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
