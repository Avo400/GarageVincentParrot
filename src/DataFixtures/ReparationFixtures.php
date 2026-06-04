<?php

namespace App\DataFixtures;

use App\Entity\Reparation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ReparationFixtures extends Fixture
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
        {
            $faker = Faker\Factory::create('fr_FR'); 

        for($repa = 1; $repa <=5; $repa++) {
                $reparation = new Reparation();
                $reparation->setCode($faker->text(15));
                $reparation->setPrixMoyen($faker->numberBetween(30,800));
                $reparation->setNomReparation($faker->text(50));
                
                $manager->persist($reparation);

                $this->addReference('repa-'.$this->counter, $reparation);
                $this->counter++;
        }
        $manager->flush();

        }

}
