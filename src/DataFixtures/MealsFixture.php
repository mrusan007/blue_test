<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\DataFixtures\CategorysFixture;
use App\DataFixtures\TagsFixture;
use App\DataFixtures\IngredientsFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Meals;



class MealsFixture extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {   
        $mealsTitles = array(
            'hamburger', 'cake', 'pizza', 'sausages', 'instant pot pork', 'black bean soup', 'mushroom pasta', 'eggplant steak frites',
            'pumpkin chilli'
            );

        for($j=0;$j<10;$j++){
        
        $random1 = rand(0,9);
        $random2 = rand(0,9);
        $refrenceCategory = $this->getReference("App\Entity\Category_$random1");
        $refrenceTags1 = $this->getReference("App\Entity\Tags_$random1");
        $refrenceTags2 = $this->getReference("App\Entity\Tags_$random2");
        $refrenceIngredients1 = $this->getReference("App\Entity\Ingredients_$random1");
        $refrenceIngredients2 = $this->getReference("App\Entity\Ingredients_$random2");
        
        $meals = new Meals();
        $meals->setTitle($mealsTitles[$random1])
            ->setCategory($refrenceCategory)
            ->addTag($refrenceTags1)
            ->addTag($refrenceTags2)
            ->addIngredient($refrenceIngredients1)
            ->addIngredient($refrenceIngredients2);
            
            
        $manager->persist($meals);
        $manager->flush();
        }
        
    }

    public function getDependencies():array
    {
        return [
            CategorysFixture::class,
            TagsFixture::class,
            IngredientsFixture::class,
        ];
    }
}
