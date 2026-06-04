<?php

namespace App\DataFixtures;

use App\Entity\GenreDemande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class GenreDemandeFixtures extends Fixture
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
        {
            $faker = Faker\Factory::create('fr_FR'); 

        for($gend = 1; $gend <=5; $gend++) {
                $genreDemande = new GenreDemande();
                $genreDemande->setLibelleGenreDemande($faker->text(8));
                
                $manager->persist($genreDemande);

                $this->addReference('gend-'.$this->counter, $genreDemande);
                $this->counter++;
        }
        $manager->flush();

        }

}
