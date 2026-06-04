<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use App\Repository\ReparationRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Reparation;
use App\Entity\Vehicule;
use App\Form\CreateUserEmployeType;
use App\Form\VehiculeType;
use App\Form\ReparationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;





#[IsGranted('ROLE_EMPLOYE')]
class EmployeController extends AbstractController
{
    #[Route('/employe/', name: 'employe_dashboard')]
    public function index(): Response
    {
        return $this->render('employe/dashboard.html.twig', [
            'controller_name' => 'EmployeController',
        ]);
    }

    #[Route('/employe/comptes', name: 'employe_comptes')]
    public function employeComptes(UserRepository $userRepository, Request $request): Response
    {
        //Afficher résultats de recherche pour email ou afficher toute la liste des users
        
        $searchEmail =$request->query->get('searchEmail');
        if ($searchEmail) {
            $users = $userRepository->searchUsersByEmail($searchEmail);

        } else {
            $users = $userRepository->findAll();

        }
        return $this->render('employe/comptes.html.twig', [
            'users' => $users,
            'searchEmail'=> $searchEmail
        ]);
    }

     #[Route('/employe/donnees', name: 'employe_donnees')]
    public function employeDonnees(): Response
    {
        return $this->render('employe/donnees.html.twig', [
            'controller_name' => 'EmployeController',
        ]);
    }

    #[Route('/employe/create', name: 'employe_create_user')]
    public function createUser(Request $request,
                    ManagerRegistry $doctrine,
                    UserPasswordHasherInterface $userPasswordHasher
    ): Response
    {
        $manager = $doctrine->getManager();
        $user = new User();
        $form = $this->createForm(CreateUserEmployeType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $form->get('plainPassword')->getData();
             $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $password
                )
            );
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                'Compte crée avec succès.'
            );
            return $this->redirectToRoute('employe_comptes');

        }
        return $this->render('employe/create_user.html.twig', [
            'formUser' => $form->createView()
        ]);
    } 






    #[Route('/employe/show/{id}', name: 'employe_show_user')]
    public function showUser(User $user, Request $request): Response {
        
        $searchEmail =$request->query->get('searchEmail');
        return $this->render('employe/show_user.html.twig', [
                'user' => $user,
                'searchEmail'=> $searchEmail 
            ]);
             
    }

    #[Route('/employe/vehicules', name: 'employe_vehicules')]
    public function vehicules(VehiculeRepository $vehiculeRepository)
    {
        $vehicules = $vehiculeRepository->findAll();
        return $this->render('employe/vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules'=> $vehicules,
        ]);
    }
    #[Route('/employe/vehicule/create', name: 'employe_vehicule_create')]
    public function createVehicule(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $vehicule = $form->getData();
            $manager->persist($vehicule);
            $manager->flush();
             $this->addFlash(
                'success',
                'Véhicule ajouté avec succès.'
            );
            return $this->redirectToRoute('employe_vehicules');
        }

        return $this->render('employe/vehicule/create.html.twig', [
             'formVehicule' => $form->createView(),
            
        ]);
    }

    #[Route('/employe/vehicule/edit/{id}', name: 'employe_vehicule_edit')]
    public function editVehicule(Vehicule $vehicule, Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->flush();
            $this->addFlash(
                'success',
                'Véhicule modifié avec succès.'
            );
            return $this->redirectToRoute('employe_vehicules');
        }
        return $this->render('employe/vehicule/edit.html.twig', [
             'formVehicule' => $form->createView(),

        ]);
    }

    #[Route('/employe/reparations', name: 'employe_reparations')]
    public function reparations(ReparationRepository $reparationRepository)
    {
        $reparations = $reparationRepository->findAll();
        return $this->render('employe/reparation/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'reparations'=> $reparations,
        ]);
    }

     #[Route('/employe/reparation/create', name: 'employe_reparation_create')]
    public function createReparation(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $reparation = new Reparation();
        $form = $this->createForm(ReparationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reparation = $form->getData();
            $manager->persist($reparation);
            $manager->flush();
             $this->addFlash(
                'success',
                'Réparation ajoutée avec succès.'
            );
            return $this->redirectToRoute('employe_reparations');
        }
        return $this->render('employe/reparation/create.html.twig' , [
            'formReparation' => $form->createView(),

        ]);
    }

    #[Route('/employe/reparation/edit/{id}', name: 'employe_reparation_edit')]
    public function editReparation(Reparation $reparation, Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $form = $this->createForm(ReparationType::class, $reparation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->flush();
            $this->addFlash(
                'success',
                'Réparation modifiée avec succès.'
            );
            return $this->redirectToRoute('employe_reparations');
            
        }
        return $this->render('employe/reparation/edit.html.twig', [
            'formReparation' => $form->createView(),
            
        ]);
    }

     #[Route('/employe/reparation/delete/{id}', name: 'employe_reparation_delete')]
    public function deleteReparation(Reparation $reparation, Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $manager->remove($reparation);
        $manager->flush();
        $this->addFlash(
                'success',
                'Réparation supprimée avec succès.'
            );
        return $this->redirectToRoute('employe_reparations');

    }




}
