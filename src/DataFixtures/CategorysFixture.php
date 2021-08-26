<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\Entity\Category;


class CategorysFixture extends BaseFixture
{

    private static $categoryTitles = [
    'breakfast', 'brunch', 'dinner', 'desert', 'lunch', 'something',
    ];

    public function loaddata(ObjectManager $manager)
    {
        $this->createMany(Category::class, 10, function(Category $category, $count) {
            $category->setTitle($this->faker->randomElement(self::$categoryTitles))
                ->setSlug($this->faker->name);
        });
        
    }
}
