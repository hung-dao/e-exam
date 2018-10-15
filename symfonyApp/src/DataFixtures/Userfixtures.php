<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Userfixtures extends Fixture
{
    public function load(ObjectManager $manager) {
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

        //teacher 2
        $dummyUser = new User();
        $dummyUser->setName("Laura Laitinen");
        $dummyUser->setUsername('teacher2');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(1); //1 = teacher;
        $manager->persist($dummyUser);
        $manager->flush();

        //teacher 3
        $dummyUser = new User();
        $dummyUser->setName("Laura Teacher3");
        $dummyUser->setUsername('teacher3');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(1); //1 = teacher;
        $manager->persist($dummyUser);
        $manager->flush();

        //teacher 4
        $dummyUser = new User();
        $dummyUser->setName("Laura Kanna");
        $dummyUser->setUsername('teacher4');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(1); //1 = teacher;
        $manager->persist($dummyUser);
        $manager->flush();

        //students
        $dummyUser = new User();
        $dummyUser->setName("Ammie Karkkinen");
        $dummyUser->setUsername('student');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(0); //0 = student;
        $manager->persist($dummyUser);
        $manager->flush();

        //student 2
        $dummyUser = new User();
        $dummyUser->setName("Ammi Karkkinen");
        $dummyUser->setUsername('student2');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(0); //0 = student;
        $manager->persist($dummyUser);
        $manager->flush();

        //student 3
        $dummyUser = new User();
        $dummyUser->setName("Emmi Karkkinen");
        $dummyUser->setUsername('student3');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(0); //0 = student;
        $manager->persist($dummyUser);
        $manager->flush();

        //student 3
        $dummyUser = new User();
        $dummyUser->setName("Emmi Kottkantie");
        $dummyUser->setUsername('student4');
        $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        $dummyUser->setRole(0); //0 = student;
        $manager->persist($dummyUser);
        $manager->flush();
    }
}
