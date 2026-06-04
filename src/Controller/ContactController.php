<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CurrentVehiculeService;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contacts' => $contacts
        ]);
    }
    
    #[Route('/contact/new', name: 'contact_create')]
    public function addContact(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class);
        $form->remove('user');
       /*   if () {
        $form->remove('titre');
        }  */
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $contact = $form->getData();
            $contact->setUser($this->getUser());
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.'
            );

            return $this->redirectToRoute('main');
        }
        return $this->render('contact/create.html.twig' , [
            'formContact' => $form->createView(),
            'isEditMode' => false
            

        ]);
       
    }

    #[Route('/contact/new/fromEmploye', name: 'contact_create_from_employe')]
    public function addContactFromEmploye(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();
            return $this->render('contact/show.html.twig', 
            ['contact' => $contact]);
        }
        return $this->render('contact/create.html.twig' , [
            'formContact' => $form->createView(),
            'isEditMode' => false
            

        ]);
       
    }

    #[Route('/contact/new/fromVehicule/{vehiculeLibelle}', name: 'contact_create_from_vehicule')]
    public function addContactFromVehicule(Request $request, ManagerRegistry $doctrine, String $vehiculeLibelle)
    {
        $manager = $doctrine->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class);
        $form->remove('user');
        $form->remove('titre');
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $contact = $form->getData();
            $contact->setUser($this->getUser());
            $titre = $vehiculeLibelle;
            $contact->setTitre($titre);
            $manager->persist($contact);
            $manager->flush();
            return $this->render('contact/show.html.twig', 
            ['contact' => $contact]);
        }
        return $this->render('contact/createFromVehicule.html.twig' , [
            'formContact' => $form->createView(),
            'isEditMode' => false
            

        ]);
       
    }

    #[Route('/contact/edit/{id}', name: 'contact_edit')]
    public function editContact(Contact $contact, Request $request, ManagerRegistry $doctrine) {
        //  $this->denyAccessUnlessGranted('ROLE_EMPLOYE');
        $manager = $doctrine->getManager();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $contactData = $form->getData();
            $manager->persist($contactData);
            $manager->flush();
            return $this->render('contact/show.html.twig', 
            ['contact' => $contact]);
        }
        return $this->render('contact/create.html.twig' , [
            'formContact' => $form->createView(),
            'isEditMode' => $contact->getId() !== null
        ]);
        
    }
    #[Route('/contact/delete/{id}', name: 'contact_delete')]
    public function deleteContact(EntityManagerInterface $entityManager, ContactRepository $contactRepository, int $id)
    {
        
       
        $contact = $entityManager->getRepository(Contact::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'No contact found for id '.$id
            );
        }
        $entityManager->remove($contact);
        $entityManager->flush();
        $contacts = $contactRepository->findAll();
        return $this->redirectToRoute('admin_contact');
		}
    

}
