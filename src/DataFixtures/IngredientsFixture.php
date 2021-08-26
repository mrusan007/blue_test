<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BaseFixture;
use App\Entity\Ingredients;


class IngredientsFixture extends BaseFixture
{

    private static $ingredientsTitles = [
    'breadcrumbs', 'salmon', 'pork', 'chicken', 'mushrooms', 'shark', 'zander', 'wels catfish', '
    salad', 'ice cream', 'vanilla'
    ];

    public function loaddata(ObjectManager $manager)
    {
        $this->createMany(Ingredients::class, 10, function(Ingredients $ingredients, $count) {
            $ingredients->setTitle($this->faker->randomElement(self::$ingredientsTitles))
                ->setSlug($this->faker->name);
        });
        
    }
}
