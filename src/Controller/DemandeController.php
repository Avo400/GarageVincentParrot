<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(): Response
    {
        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
        ]);
    }
    #[Route('/demande/new', name: 'demande_create')]
    #[Route('/demande/{id}/edit', name: 'demande_edit')]
    public function form(Demande $demande = null, Request $request, ManagerRegistry $doctrine) 
    {
        $manager = $doctrine->getManager();
        if (!$demande){
            $demande = new Demande();
       }
      /*  $form = $this->createFormBuilder($demande)
        ->add('title')
        ->add('content')
        ->add('image')
        ->getForm(); */
        $form = $this->createForm(DemandeType::class, $demande);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($demande);
            $manager->flush();
            return $this->render('demande/show.html.twig', 
            ['demande' => $demande]);
        }
        return $this->render('demande/create.html.twig' , [
            'formDemande' => $form->createView(),
            'isEditMode' => $demande->getId() !== null
        ]);
    }

    #[Route('/demande/{id}', name: 'demande_show')]
    public function show(DemandeRepository $repo, $id): Response
    {
        $demande = $repo->find($id);
        return $this->render('demande/show.html.twig', [
            'controller_name' => 'DemandeController',
            'demande' => $demande
        ]);
    }
}
