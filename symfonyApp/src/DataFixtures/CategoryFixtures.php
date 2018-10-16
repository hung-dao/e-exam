<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $dummyCategory1 = new Category();
        $dummyCategory1->setCategoryName("Math");

        $dummyCategory2 = new Category();
        $dummyCategory2->setCategoryName("History");

        $dummyCategory3 = new Category();
        $dummyCategory3->setCategoryName("Computer");

        $dummyCategory4 = new Category();
        $dummyCategory4->setCategoryName("Geography");

        $dummyCategory5 = new Category();
        $dummyCategory5->setCategoryName("Literature");

        $manager->persist($dummyCategory1);
        $manager->persist($dummyCategory2);
        $manager->persist($dummyCategory3);
        $manager->persist($dummyCategory4);
        $manager->persist($dummyCategory5);

        $manager->flush();
    }
}
