<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create('fr_FR');
        for($i=0;$i<100;$i++)
        {
            $property= new Property();
            $property
        ->setTitle($faker->word(3,true))
        ->setDescription($faker->sentences(3,true))
        ->setSurface($faker->numberBetween(20,350))
        ->setChambres($faker->numberBetween(1,6))
        ->setPieces($faker->numberBetween(1,9))
        ->setEtage($faker->numberBetween(1,5))
        ->setPrix($faker->numberBetween(35000,700000))
        ->setCity($faker->city)
        ->setAdresse($faker->address)
        ->setCodePostal($faker->postcode);

        $manager->persist($property);

     }
   
        $manager->flush();
    }
}
