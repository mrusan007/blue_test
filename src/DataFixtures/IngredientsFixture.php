<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BaseFixture;
use App\Entity\Ingredients;
use App\Entity\IngredientsTranslation;
use Gedmo\Translatable\TranslatableListener;



class IngredientsFixture extends Fixture
{

    private static $ingredientsTitles = [
    'breadcrumbs', 'salmon', 'pork', 'chicken', 'mushrooms', 'shark', 'zander', 'wels catfish', '
    salad', 'ice cream', 'vanilla'
    ];

    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */
        $ingredientsTran = new IngredientsTranslation('fr', 'title', 'morgen');
        
        $ingredients = new Ingredients();
        $ingredients->setTitle('food')
            ->setSlug('slug123')
            ->addTranslation($ingredientsTran);
        $manager->persist($ingredients);
        $manager->flush();
        $this->addReference('ingredients',$ingredients);

        
    }
}
