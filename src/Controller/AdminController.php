<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Avis;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\UserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\CreateUserType;
use App\Form\EditUserType;
use App\Entity\EtatOuvertureGarage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\VehiculeRepository;
use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Form\ReparationType;
use App\Repository\DemandeRepository;
use App\Repository\ReparationRepository;
use App\Repository\ContactRepository;
use App\Entity\Reparation;
use App\Entity\Contact;
use App\Repository\AvisRepository;






#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
   #[Route('/admin/', name: 'admin_dashboard')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    {
         $garage = $entityManager
        ->getRepository(EtatOuvertureGarage::class)
        ->find(1);
        return $this->render('admin/dashboard.html.twig', [
            'garage' => $garage
        ]);
    }

    #[Route('/admin/comptes', name: 'admin_comptes')]
    public function comptes(UserRepository $userRepository, Request $request): Response
    {
        //Afficher résultats de recherche pour email ou afficher toute la liste des users

        $searchEmail =$request->query->get('searchEmail');
        if ($searchEmail) {
            $users = $userRepository->searchUsersByEmail($searchEmail);

        } else {
            $users = $userRepository->findAll();

        }
        return $this->render('admin/comptes.html.twig', [
            'users' => $users,
            'searchEmail'=> $searchEmail 
        ]);
    }

    #[Route('/admin/donnees', name: 'admin_donnees')]
    public function donnees(): Response
    {
        return $this->render('admin/donnees.html.twig');
    }

    #[Route('/admin/create', name: 'admin_create_user')]
    public function createUser(Request $request,
                    ManagerRegistry $doctrine,
                    UserPasswordHasherInterface $userPasswordHasher
    ): Response
    {
        $manager = $doctrine->getManager();
        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);
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
            return $this->redirectToRoute('admin_comptes');

        }
        return $this->render('admin/create_user.html.twig', [
            'formUser' => $form->createView()
        ]);
    } 

    #[Route('/admin/show/{id}', name: 'admin_show_user')]
    public function showUser(User $user, Request $request): Response {
        
        $searchEmail =$request->query->get('searchEmail');
        return $this->render('admin/show_user.html.twig', [
                'user' => $user,
                'searchEmail'=> $searchEmail 
            ]);
             
    }




     #[Route('/admin/edit/{id}', name: 'admin_edit_user')]
    public function editUser(User $user, Request $request, ManagerRegistry $doctrine) {
        $manager = $doctrine->getManager();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données de l'user créé dans le create form.
            $userData = $form->getData();
            $manager->persist($userData);
            $manager->flush();
            return $this->redirectToRoute('admin_comptes');
        }
            return $this->render('admin/edit_user.html.twig', [
            'formUser' => $form->createView()
            
        ]);
        
    }

    
     #[Route('/admin/delete/{id}', name: 'admin_delete_user')]
    public function deleteUser(User $user, Request $request, ManagerRegistry $doctrine) {
        $manager = $doctrine->getManager();
        $manager->remove($user);
        $manager->flush();
        return $this->redirectToRoute('admin_comptes');

       
        
    }

    #[Route('/admin/isopen', name: 'admin_isopen')]
    public function isOpen(EntityManagerInterface $entityManager)
    {

       $garage = $entityManager
        ->getRepository(EtatOuvertureGarage::class)
        ->find(1);
        $garage->setIsOpen(!$garage->isIsOpen());
        $entityManager->flush();

        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/admin/search/{id}', name: 'admin_search_user')]
    public function searchUserByMail(User $user, Request $request, ManagerRegistry $doctrine) {
        $manager = $doctrine->getManager();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données de l'user créé dans le create form.
            $userData = $form->getData();
            

            $manager->persist($userData);
            $manager->flush();
            return $this->redirectToRoute('admin_comptes');
        }
            return $this->render('admin/edit_user.html.twig', [
            'formUser' => $form->createView()
            
        ]);
        
    }

    #[Route('/admin/vehicules', name: 'admin_vehicules')]
    public function vehicules(VehiculeRepository $vehiculeRepository)
    {
        $vehicules = $vehiculeRepository->findAll();
        return $this->render('admin/vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules'=> $vehicules,
        ]);
    }

    #[Route('/admin/vehicule/create', name: 'admin_vehicule_create')]
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

            return $this->redirectToRoute('admin_vehicules');
        }

        return $this->render('admin/vehicule/create.html.twig', [
             'formVehicule' => $form->createView(),
            
        ]);
    }


    #[Route('/admin/vehicule/edit/{id}', name: 'admin_vehicule_edit')]
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

            return $this->redirectToRoute('admin_vehicules');
        }
        return $this->render('admin/vehicule/edit.html.twig', [
             'formVehicule' => $form->createView(),

        ]);
    }

     #[Route('/admin/vehicule/delete/{id}', name: 'admin_vehicule_delete')]
    public function deleteVehicule(EntityManagerInterface $entityManager, DemandeRepository $demandeRepository, VehiculeRepository $vehiculeRepository,int $id)
    {
                 
       $demandes = $demandeRepository->findAll();
       foreach ($demandes as $demande) {
            if ($demande->getVehicule()->getId() === $id) {
                $entityManager->remove($demande);
                $entityManager->flush();
            }

       }
        
        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);

        if (!$vehicule) {
            throw $this->createNotFoundException(
                'No vehicule found for id '.$id
            );
        }
        $entityManager->remove($vehicule);
        $entityManager->flush();
        $this->addFlash(
                'success',
                'Véhicule supprimé avec succès.'
        );
        return $this->redirectToRoute('admin_vehicules');
                    
    }
            
    #[Route('/admin/reparations', name: 'admin_reparation')]
    public function reparation(ReparationRepository $reparationRepository)
    {
        $reparations = $reparationRepository->findAll();
        return $this->render('admin/reparation/index.html.twig', [
            'controller_name' => 'ReparationController',
            'reparations'=> $reparations,
        ]);
       
    }

    #[Route('/admin/reparation/create', name: 'admin_reparation_create')]
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
            return $this->redirectToRoute('admin_reparation');
        }
        return $this->render('admin/reparation/create.html.twig' , [
            'formReparation' => $form->createView(),

        ]);
    }

    #[Route('/admin/reparation/edit/{id}', name: 'admin_reparation_edit')]
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
            return $this->redirectToRoute('admin_reparation');
            
        }
        return $this->render('admin/reparation/edit.html.twig', [
            'formReparation' => $form->createView(),
            
        ]);
    }

     #[Route('/admin/reparation/delete/{id}', name: 'admin_reparation_delete')]
    public function delete(EntityManagerInterface $entityManager,ReparationRepository $repo, int $id): Response
    {

        $reparation = $entityManager->getRepository(Reparation::class)->find($id);

        if (!$reparation) {
            throw $this->createNotFoundException(
                'No reparation found for id '.$id
            );
        }

        $entityManager->remove($reparation);
		$entityManager->flush();
         $this->addFlash(
                'success',
                'Réparation supprimée avec succès.'
            );
        return $this->redirectToRoute('admin_reparation');
    }


    #[Route('/admin/aviss', name: 'admin_avis')]
    public function aviss(AvisRepository $avisRepository)
    {
        $aviss = $avisRepository->findAll();
        return $this->render('admin/avis/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'aviss'=> $aviss,
        ]);
    }

     #[Route('/admin/avis/approved/{id}', name: 'admin_avis_approved')]
    public function avisApproved(
    Avis $avis,
    EntityManagerInterface $entityManager
    )
    {
        $avis->setApproved(!$avis->isApproved());

        $entityManager->flush();

        return $this->redirectToRoute('admin_avis');

        
    }

     #[Route('/admin/avis/delete/{id}', name: 'admin_avis_delete')]
    public function deleteAvis(EntityManagerInterface $entityManager, int $id)
    {


        $avis = $entityManager->getRepository(Avis::class)->find($id);

        if (!$avis) {
            throw $this->createNotFoundException(
                'No avis found for id '.$id
            );
        }
        $entityManager->remove($avis);
        $entityManager->flush();
        $this->addFlash(
                'success',
                'Avis supprimé avec succès.'
        );
        return $this->redirectToRoute('admin_avis');
                    
    }

    #[Route('/admin/contacts', name: 'admin_contact')]
    public function contact(ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->findAll();
        return $this->render('admin/contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contacts'=> $contacts,
        ]);
    }

    #[Route('/admin/contact/delete/{id}', name: 'admin_contact_delete')]
    public function deleteContact(EntityManagerInterface $entityManager, int $id)
    {

        $contact = $entityManager->getRepository(Contact::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'No avis found for id '.$id
            );
        }
        $entityManager->remove($contact);
        $entityManager->flush();
        $this->addFlash(
                'success',
                'Message supprimé avec succès.'
        );
        return $this->redirectToRoute('admin_contact');
                    
    }



    

    }
