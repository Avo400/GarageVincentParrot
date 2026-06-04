<?php

namespace App\DataFixtures;

use App\Entity\Demande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class DemandeFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
        {
            $faker = Faker\Factory::create('fr_FR'); 

        for($dem = 1; $dem <=5; $dem++) {
                $demande = new Demande();
               // On va chercher une référence de vehicule
                $vehicule = $this->getReference('veh-'.rand(1,5));
                $demande->setVehicule($vehicule);

                // On va chercher une référence de etat demande
                $etatDemande = $this->getReference('etd-'.rand(1,5));
                $demande->setEtatDemande($etatDemande);

                $demande->setSujet($faker->text(8));
                $demande->setContenuMessage($faker->text());

                // On va chercher une référence de etat demande
                $genreDemande = $this->getReference('gend-'.rand(1,5));
                $demande->setGenreDemande($genreDemande);

                $manager->persist($demande);
               
        }
        $manager->flush();

        }
        public function getDependencies(): array {
            return [
                GenreDemandeFixtures::class, 
                EtatDemandeFixtures::class,
                VehiculeFixtures::class
            ];
        }

}
