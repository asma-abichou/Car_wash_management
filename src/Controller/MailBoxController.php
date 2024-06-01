<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted('ROLE_USER')]
class MailBoxController extends AbstractController
{
    #[Route('/mail', name: 'mail_box_page')]
    function home () : Response
    {
        return $this->render('MailBox/mailBox.html.twig');

    }


}