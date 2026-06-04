<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EtatOuvertureGarage;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EtatOuvertureGarageType;
use App\Repository\EtatOuvertureGarageRepository;
use App\Entity\Reparation;
use App\Repository\ReparationRepository;



class EtatOuvertureGarageController extends AbstractController
{
    #[Route('/ouverture', name: 'app_etat_ouverture_garage')]
    public function index(EtatOuvertureGarageRepository $repo): Response
    {
        $etatOuverture = $repo->findAll();
        return $this->render('etat_ouverture_garage/index.html.twig', [
            'controller_name' => 'EtatOuvertureGarageController',
         ]);
    }

    #[Route('/ouverture/edit/{id}', name: 'etat_ouverture_garage_edit')]
    public function editEtatOuvertureGarage(EtatOuvertureGarage $etatOuvertureGarage, Request $request, ManagerRegistry $doctrine, ReparationRepository $repo) {
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $manager = $doctrine->getManager();
        $etatOuverture = null;
        $reparations = $repo->findAll();
        $form = $this->createForm(EtatOuvertureGarageType::class, $etatOuvertureGarage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etatOuvertureGarageData = $form->getData();
            $manager->persist($etatOuvertureGarageData);
            $manager->flush();
            return $this->redirectToRoute('admin_dashboard');
        }
        return $this->render('etat_ouverture_garage/create.html.twig' , [
            'formOuverture' => $form->createView(),
        ]);
               
    }
}
