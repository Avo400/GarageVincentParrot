<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Avis;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class AvisFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR'); 
        for ($avs = 1; $avs <= 10; $avs++) {
            $avis = new Avis();
            $avis->setNote($faker->numberBetween(1,5));
            $avis->setTitre($faker->text(15));
            $avis->setContenuMessageAvis($faker->text());

            // On va chercher une référence de User
            $user = $this->getReference('usr-'.rand(1,5));
            $avis->setUser($user);

            $manager->persist($avis);
        }
        $manager->flush();
    }
    public function getDependencies(): array {
        return [
            UsersFixtures::class
        ];
    }
}
