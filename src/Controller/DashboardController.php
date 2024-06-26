<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\MyProfileFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/dashboard')]
#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }
    #[Route('/home', name: 'home_page')]
    function home () : Response
    {

        return $this->render('template.html.twig');

    }

    #[Route('/profile', name: 'profile_page')]
    #[IsGranted('ROLE_USER')]
    function profile (Request $request, UserRepository $userRepository , SluggerInterface $slugger,) : Response
    {
        $userEmail = $this->getUser()->getUserIdentifier();
        $currentUser = $userRepository->findOneBy(["email" => $userEmail]);
        //dd($currentUser);
        $form = $this->createForm(MyProfileFormType::class, $currentUser);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $profileImageFile */
            $profileImageFile = $form->get('profileImage')->getData();
            if ($profileImageFile) {
                $originalFilename = pathinfo($profileImageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $profileImageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $profileImageFile->move(
                        $this->getParameter('profile_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $currentUser->setProfileImage($newFilename);
            }
            $this->entityManager->persist($currentUser);
            $this->entityManager->flush();
            $this->addFlash('editProfileSuccess', 'Vos informations ont été modifiés avec succès!');
            return $this->redirectToRoute('profile_page');

        }
        return $this->render('profile/profile.html.twig', [
            'myProfileForm' => $form->createView(),
        ]);

    }


    #[Route('/show', name: 'calendar_page')]
    function showCalendar () : Response
    {
        return $this->render('calendar/calendar.html.twig');

    }

    #[Route('/profileList', name: 'show_Profile_saved')]
    function profileCreated (UserRepository $userRepository) : Response
    {
        $clients = $userRepository->findBy(['roles' => 'ROLE_OWNER']);
        //dd($clients);
        return $this->render('ClientProfileList/listProfile.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/mail', name: 'mail_box_page')]
    function emailBox () : Response
    {
        return $this->render('MailBox/mailBox.html.twig');

    }
}