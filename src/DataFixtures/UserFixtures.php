<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User ;

class UserFixtures extends Fixture

{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
       $this->encoder=$encoder ; 
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setPassword($this->encoder->encodePassword($user,"mypassword"));
        $user->setEmail("test@test.sn");
        
        $manager->persist($user);

        $manager->flush();
    }
}
