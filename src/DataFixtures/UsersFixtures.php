<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;
    private $counter = 1;
    public function __construct(UserPasswordHasherInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
       $admin = new User();
       $admin->setEmail("vincentparrot@gmail.com");
       $admin->setRoles(['ROLE_ADMIN']);
       $admin->setPassword(
        $this->passwordEncoder->hashPassword($admin, 'azerty123')
       );
       $admin->setLastname("parrot");
       $admin->setFirstname("vincent");
       $admin->setAddress("3 rue du pain");
       $admin->setZipcode("74100");
       $admin->setCity("Annecy");
       $manager->persist($admin);

       $faker = Faker\Factory::create('fr_FR'); 

       for($usr = 1; $usr <=5; $usr++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode($faker->postcode);
            $user->setCity($faker->city);
            $manager->persist($user);

            $this->addReference('usr-'.$this->counter, $user);
            $this->counter++;
       }
       $manager->flush();

    }

}
