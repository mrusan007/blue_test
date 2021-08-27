<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\DataFixtures\CategoriesFixture;
use App\DataFixtures\TagsFixture;
use App\DataFixtures\IngredientsFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Meals;
use \Datetime;


class MealsFixture extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {   
        $mealsTitles = array(
            'hamburger', 'cake', 'pizza', 'sausages', 'instant pot pork', 'black bean soup', 'mushroom pasta', 'eggplant steak frites',
            'pumpkin chilli'
            );

        
        
       
        $refrenceCategory = $this->getReference("category");
        $refrenceTags1 = $this->getReference("tags");
        $refrenceIngredients1 = $this->getReference("ingredients");
        
        
        $meals = new Meals();
        $meals->setTitle($mealsTitles[2])
            ->setCategory($refrenceCategory)
            ->addTag($refrenceTags1)
            ->addIngredient($refrenceIngredients1)
            ->setDescription('Opis')
            ->setCreatedAt(new DateTime('2011-01-01T15:03:01.012345Z'));
            
            
        $manager->persist($meals);
        $manager->flush();
        
        
    }

    public function getDependencies():array
    {
        return [
            CategoriesFixture::class,
            TagsFixture::class,
            IngredientsFixture::class,
        ];
    }
}
