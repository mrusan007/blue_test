<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use Gedmo\Translatable\TranslatableListener;


class CategoriesFixture extends Fixture
{

    private static $categoryTitles = [
    'breakfast', 'brunch', 'dinner', 'desert', 'lunch', 'something',
    ];
    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */
        $categoryTran = new CategoryTranslation('fr', 'title', 'morgen');
        
        $category = new Category();
        $category->setTitle('food')
            ->setSlug('slug123')
            ->addTranslation($categoryTran);
        $manager->persist($category);
        $manager->flush();
        $this->addReference('category',$category);

        
    }
}
