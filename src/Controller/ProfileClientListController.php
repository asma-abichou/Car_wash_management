<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted('ROLE_USER')]
class ProfileClientListController extends AbstractController
{
    #[Route('/profileList', name: 'show_Profile_saved')]
    function ProfileList () : Response
    {
        return $this->render('ClientProfileList/listProfile.html.twig');

    }

}