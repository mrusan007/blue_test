<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BaseFixture;
use App\Entity\Category;


class AppFixtures extends Fixture
{

    // private static $categoryTitles = [
    // 'breakfast', 'brunch', 'dinner', 'desert', 'lunch', 'something',
    // ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        
    }
    
}
