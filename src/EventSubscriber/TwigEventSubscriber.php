<?php

namespace App\EventSubscriber;

 use Symfony\Component\EventDispatcher\EventSubscriberInterface;
 use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
use App\Repository\EtatOuvertureGarageRepository;     
use Symfony\Component\HttpKernel\Event\RequestEvent;

 class TwigEventSubscriber implements EventSubscriberInterface
 {
    private $twig;
   private $etatOuvertureGarageRepository;
   public function __construct(Environment $twig, EtatOuvertureGarageRepository $etatOuvertureGarageRepository)
    {
        $this->twig = $twig;
        $this->etatOuvertureGarageRepository = $etatOuvertureGarageRepository;
    }

     /* public function onControllerEvent(RequestEvent $event): void
     {
        /* $isOpen = $findFirstRow->isIsOpen();
        $this->twig->addGlobal('isOpen', $isOpen); 
        $this->twig->addGlobal('etats', $this->etatOuvertureGarageRepository->findAll());
     } */

     public static function getSubscribedEvents(): array {
      return [
         RequestEvent::class => 'onKernelRequest'
     ];
     }

     public function onKernelRequest(RequestEvent $event)
    {
      $this->twig->addGlobal('etat', $this->etatOuvertureGarageRepository->find(1));
    }
 }
