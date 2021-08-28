<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BaseFixture;
use App\Entity\Ingredients;
use App\Entity\IngredientsTranslation;
use Gedmo\Translatable\TranslatableListener;
use Faker\Factory;


class IngredientsFixture extends Fixture
{

    protected $faker;


    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */
        $ingredientsTitles = [
            'breadcrumbs', 'salmon', 'pork', 'chicken', 'mushrooms', 'shark', 'zander', 'wels catfish', '
            salad', 'ice cream', 'vanilla'
            ];
        $this->faker = Factory::create();
        for($i=0;$i<count($ingredientsTitles);$i++){

        
        $translations = array(new IngredientsTranslation('es', 'title', "translation_es_$i"), 
            new IngredientsTranslation('fr', 'title', "translation_fr_$i"));
        

        $ingredients = new Ingredients();
        $ingredients->setTitle($ingredientsTitles[$i])
            ->setSlug($this->faker->name)
            ->addTranslation($translations);
        $manager->persist($ingredients);
        $manager->flush();
        $this->addReference("ingredients_$i",$ingredients);
        }
        
    }
}
