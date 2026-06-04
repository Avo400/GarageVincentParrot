<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis/', name: 'avis_index')]
    public function index(AvisRepository $repo): Response
    {
        
        $aviss = $repo->findAll();
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $aviss
        ]);
    }
    #[Route('/avis/new', name: 'avis_new')]
    public function addAvis(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager();
        $avis = new Avis();
        $form = $this->createForm(AvisType::class);
        $form->remove('user');
        $form->remove('approved');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis = $form->getData();
            $avis->setUser($this->getUser());
            $avis->setApproved(true);
            $manager->persist($avis);
            $manager->flush();
            return $this->redirectToRoute('avis_index');
            
        }
        return $this->render('avis/create.html.twig' , [
            'formAvis' => $form->createView(),
            'isEditMode' => false

        ]);
       
    } 


    #[Route('/avis/edit/{id}', name: 'avis_edit')]
    public function editAvis(Avis $avis, Request $request, ManagerRegistry $doctrine) {
        $manager = $doctrine->getManager();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $avisData = $form->getData();
            $manager->persist($avisData);
            $manager->flush();
            return $this->redirectToRoute('avis_index');
           
        }
        return $this->render('avis/edit.html.twig' , [
            'formAvis' => $form->createView(),
            'isEditMode' => $avis->getId() !== null
        ]);

    }
        

    #[Route('/avis/delete/{id}', name: 'avis_delete')]
    public function deleteAvis(EntityManagerInterface $entityManager, int $id)
    {
        //On vérifie si l'utilisateur peut supprimer avec le Voter
        $this->denyAccessUnlessGranted('ROLE_ADMIN');


        $avis = $entityManager->getRepository(Avis::class)->find($id);

        if (!$avis) {
            throw $this->createNotFoundException(
                'No avis found for id '.$id
            );
        }
        $entityManager->remove($avis);
        $entityManager->flush();
        return $this->redirectToRoute('avis_index');
                    
    }

    #[Route('/avis/employe', name: 'avis_employe')]
    public function adminAvis(AvisRepository $repo): Response
    {
        
        $this->denyAccessUnlessGranted('ROLE_EMPLOYE');
        
        $aviss = $repo->findAll();
        
        return $this->render('avis/indexEmploye.html.twig', [
            'controller_name' => 'AvisController',
            'aviss' => $aviss
        ]);
    }
    #[Route('/avis/toggle/{id}', name: 'avis_toggle')]
    public function toggleAvis(Avis $avis, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $avis->setApproved(!$avis->isApproved());

        $entityManager->flush();

        return $this->redirectToRoute('avis_index');
    }
    




    #[Route('/avis/{id}', name: 'avis_show')]
    public function show(AvisRepository $repo, $id): Response
    {
        if ($id) {
            $avis = $repo->find($id);
            if (!$avis) {
                return $this->redirectToRoute('avis_index');
            } else {
                       return $this->render('avis/show.html.twig', [
                        'controller_name' => 'AvisController',
                        'avis' => $avis
            ]);

        }
        } else {
            return $this->redirectToRoute('avis_index');
        }
        
    }

   


    
}
