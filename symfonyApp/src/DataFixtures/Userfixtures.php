<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Userfixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        //teacher
        $dummyUser = new User();
        $dummyUser->setName("Peppi Kivisto");
        $dummyUser->setUsername('teacher');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(1); //1 = teacher;
        $manager->persist($dummyUser);
        $manager->flush();
        //students
        $dummyUser = new User();
        $dummyUser->setName("Ammie Karkkinen");
        $dummyUser->setUsername('student');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(0); //1 = teacher;
        $manager->persist($dummyUser);
        $manager->flush();
    }
}
