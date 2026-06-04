<?php

namespace App\DataFixtures;

use App\Entity\EtatDemande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EtatDemandeFixtures extends Fixture
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR'); 

       for($etd = 1; $etd <=5; $etd++) {
            $etatDemande = new EtatDemande();
            $etatDemande->setLibelleEtatDemande($faker->text(8));
            
            $manager->persist($etatDemande);

            $this->addReference('etd-'.$this->counter, $etatDemande);
            $this->counter++;
       }
       $manager->flush();

    }

}
