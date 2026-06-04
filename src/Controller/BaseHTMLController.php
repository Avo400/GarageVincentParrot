<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatOuvertureGarageRepository;


class BaseHTMLController extends AbstractController
{
   /*  #[Route('/base', name: 'app_base')]
    public function index(EtatOuvertureGarageRepository $repo): Response
    {
         $etatOuverture = $repo->find(1);
         $isOpen = $etatOuverture->isIsOpen();
        return $this->render('base.html.twig', [
            'isOpen' => $isOpen
        ]);
    }

    #[Route('/base/ouverture', name: 'app_base_ouverture')]
    public function demandsAction(EtatOuvertureGarageRepository $repo)
    {
        $etatOuverture = $repo->find(1);
        $isOpen = $etatOuverture->isIsOpen();
         return $this->render('base.html.twig', [
        'isOpen' => $isOpen
        ]); 
    } */
}
