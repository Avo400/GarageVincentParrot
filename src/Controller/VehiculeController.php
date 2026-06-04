<?php

namespace App\Controller;

use App\Data\SearchDataTest;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VehiculeType;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Demande;
use App\Form\SearchFormType;
use App\Repository\DemandeRepository;
use App\Repository\UserRepository;
use App\Service\CurrentVehiculeService;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule/', name: 'vehicule_index')]
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        // Pour les employés, on affiche tous les véhicules : disponibles ou non disponibles.
        $vehicules = $vehiculeRepository->findAll();
        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules'=> $vehicules,
        ]);
    } 
   

    #[Route('/vehicule/utilisateur', name: 'app_vehicule_utilisateur')]
    public function indexUtilisateur(VehiculeRepository $vehiculeRepository, UserRepository $userRepository, Request $request, CurrentVehiculeService $currentVehiculeService): Response
    {
        // On affiche à l'utilisateur les véhicules seulement disponibles.
         $vehicules = $vehiculeRepository->findBy(
            ['estDisponible' => 'true'],
        ); 

        // On va chercher le numéro de page dans l'url
       // $page = $request->query->getInt('page', 1);

       // $vehicules = $vehiculeRepository->findVehiculePaginated($page, 6);

        $data = new SearchDataTest();
        $data-> page =  $request->get('page', 1);
        $form = $this->createForm(SearchFormType::class, $data); 
        $form->handleRequest($request);
        [$minPrice, $maxPrice] = $vehiculeRepository->findMinMaxPrice($data);
         [$minKms, $maxKms] = $vehiculeRepository->findMinMaxKms($data);
        [$minYear, $maxYear] = $vehiculeRepository->findMinMaxYear($data);

        $vehicules = $vehiculeRepository->findSearch($data);
        // On récupère tous les users car certains possèdent des véhicules
        $users = $userRepository->findAll();
       
        $vehiculeLibelle ="";
        if ($request->get('ajax')) {
            
            return new JsonResponse([
                'content' => $this->renderView('vehicule/_vehicules.html.twig', ['vehicules' => $vehicules, 'vehicule' => $currentVehiculeService->getCurrentVehicule(), 'getCurrentService' => $currentVehiculeService]),
                'sorting' => $this->renderView('vehicule/_sorting.html.twig', ['vehicules' => $vehicules]),
            ]);
            
        }
        return $this->render('vehicule/indexUtilisateur.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules' => $vehicules,
            'users'=> $users,
            'form' => $form->createView(),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'minKms' => $minKms,
            'maxKms' => $maxKms,
            'minYear' => $minYear,
            'maxYear' => $maxYear,
        ]);
    }
    #[Route('/vehicule/show/{id}', name: 'app_vehicule_show')]
    public function showVehicule(VehiculeRepository $vehiculeRepository, int $id): Response
    {
        $vehicule = $vehiculeRepository->find($id);
        return $this->render('vehicule/show.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicule' => $vehicule
        ]);
    }

    #[Route('/vehicule/new', name: 'vehicule_create')]
    public function addVehicule(Request $request, ManagerRegistry $doctrine)
    {
        // Si un user n'est pas admin ET n'est pas employé, refuser l'accès.
         if (
            !$this->isGranted('ROLE_EMPLOYE')
            && !$this->isGranted('ROLE_ADMIN')
         ) {
            throw $this->createAccessDeniedException();
           }
        $manager = $doctrine->getManager();
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $vehicule = $form->getData();
            $manager->persist($vehicule);
            $manager->flush();
            return $this->redirectToRoute('vehicule_index');
        }
        return $this->render('vehicule/create.html.twig' , [
            'formVehicule' => $form->createView(),
            'isEditMode' => false

        ]);
       
    }

    #[Route('/vehicule/edit/{id}', name: 'vehicule_edit')]
    public function editVehicule(Vehicule $vehicule, Request $request, ManagerRegistry $doctrine) {
        if (
            !$this->isGranted('ROLE_EMPLOYE')
            && !$this->isGranted('ROLE_ADMIN')
         ) {
            throw $this->createAccessDeniedException();
           }
        $manager = $doctrine->getManager();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $vehiculeData = $form->getData();
            $manager->persist($vehiculeData);
            $manager->flush();
            return $this->redirectToRoute('vehicule_index');

        }
        return $this->render('vehicule/create.html.twig' , [
            'formVehicule' => $form->createView(),
            'isEditMode' => $vehicule->getId() !== null
        ]);
        
    }

    #[Route('/vehicule/delete/{id}', name: 'vehicule_delete')]
    public function deleteVehicule(EntityManagerInterface $entityManager, DemandeRepository $demandeRepository, VehiculeRepository $vehiculeRepository,int $id)
    {
         if (
            !$this->isGranted('ROLE_EMPLOYE')
            && !$this->isGranted('ROLE_ADMIN')
         ) {
            throw $this->createAccessDeniedException();
           }
        
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
        $vehicules = $vehiculeRepository->findAll();
       return $this->redirectToRoute('vehicule_index');
                    
    }

   
}


