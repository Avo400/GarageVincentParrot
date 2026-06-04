<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'isAdminAccount' => false,
            'isEmployeeAccount' => false

        ]);
    }

    #[Route('/inscription/employe', name: 'app_register_employe')]
    public function registerEmployee(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        // On donne l'accès à cette fonctionnalité à l'administrateur uniquement
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $employe = new User();
        $form = $this->createForm(RegistrationFormType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $employe->setPassword(
                $userPasswordHasher->hashPassword(
                    $employe,
                    $form->get('plainPassword')->getData()
                )
            );
            // On assigne le rôle d'employé à l'utilisateur
            $employe->setRoles(['ROLE_EMPLOYE']);
            $entityManager->persist($employe);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $employe,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'isAdminAccount' => false,
            'isEmployeeAccount' => true
        ]);
    }

    #[Route('/inscription/admin', name: 'app_register_admin')]
    public function registerAdmin(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        // On donne l'accès à cette fonctionnalité à l'administrateur uniquement
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $administrateur = new User();
        $form = $this->createForm(RegistrationFormType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $administrateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $administrateur,
                    $form->get('plainPassword')->getData()
                )
            );
            // On assigne le rôle d''administrateur à l'utilisateur
            $administrateur->setRoles(['ROLE_ADMIN']);
            $entityManager->persist($administrateur);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $administrateur,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
             'isAdminAccount' => true,
             'isEmployeeAccount' => false
        ]);
    }

    
}
