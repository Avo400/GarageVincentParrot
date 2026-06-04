<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatDemandeController extends AbstractController
{
    #[Route('/etat/demande', name: 'app_etat_demande')]
    public function index(): Response
    {
        return $this->render('etat_demande/index.html.twig', [
            'controller_name' => 'EtatDemandeController',
        ]);
    }
}
