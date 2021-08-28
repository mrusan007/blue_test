<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use Gedmo\Translatable\TranslatableListener;
use Faker\Factory;

class CategoriesFixture extends Fixture
{
    /** @var Generator */
    protected $faker;
    
    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */

        $categoryTitles = [
            'breakfast', 'brunch', 'dinner', 'desert', 'lunch', 'something',
            ];

        $this->faker = Factory::create();
        for($i=0;$i<count($categoryTitles);$i++){
            
            
            
            $translations = array(new CategoryTranslation('es', 'title', "translate_es_$i"),
                new CategoryTranslation('fr', 'title', "translate_fr_$i")
        );
            
            
            $category = new Category();
            $category->setTitle($categoryTitles[$i])
                ->setSlug($this->faker->name)
                ->addTranslation($translations);

        
            $manager->persist($category);
           
            $manager->flush();
            $this->addReference("category_$i",$category);
        }
        
    }
}
