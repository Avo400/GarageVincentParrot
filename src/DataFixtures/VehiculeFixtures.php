<?php

namespace App\DataFixtures;

use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\VehiculePasswordHasherInterface;
use Faker;

class VehiculeFixtures extends Fixture
{
    
    private $counter = 1;
    

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR'); 

       for($veh = 1; $veh <=5; $veh++) {
            $vehicule = new Vehicule();
            $vehicule->setLibelle($faker->text(8));
            $vehicule->setImmatriculation($faker->text(8));
            $vehicule->setPrix($faker->numberBetween(1000, 10000));
            $vehicule->setImage($faker->text(8));
            $vehicule->setAnneeMiseEnCirculation($faker->year);
            $vehicule->setKms($faker->numberBetween(10000, 400000));
            $vehicule->setEstDisponible($faker->boolean);
            $manager->persist($vehicule);

            $this->addReference('veh-'.$this->counter, $vehicule);
            $this->counter++;
       }
       $manager->flush();

    }

}
