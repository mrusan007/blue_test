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
use App\Entity\MealsTranslation;
use \Datetime;
use Faker\Factory;

class MealsFixture extends Fixture implements DependentFixtureInterface
{

    protected $faker;

    public function load(ObjectManager $manager)
    {   
        $mealsTitles = array(
            'hamburger', 'cake', 'pizza', 'sausages', 'instant pot pork', 'black bean soup', 'mushroom pasta', 'eggplant steak frites',
            'pumpkin chilli'
            );
        
        $this->faker = Factory::create();
        for($i=0;$i<count($mealsTitles);$i++){
        
        $randNum1 = rand(0,3);
        $randNum2 = rand(0,10);
        $randNum3 = rand(0,10);

        $refrenceCategory = $this->getReference("category_$randNum1");
        $refrenceTags = $this->getReference("tags_$randNum1");
        $refrenceIngredients1 = $this->getReference("ingredients_$randNum2");
        $refrenceIngredients2 = $this->getReference("ingredients_$randNum3");
       
        $translations = array(new MealsTranslation('es','description',"translation_desc_es_$i"), 
            new MealsTranslation('es','title',"translation_title_es_$i"), new MealsTranslation('fr','title',"translation_title_fr_$i"),
            new MealsTranslation('fr','description',"translation_desc_fr_$i")
        );
        
        $meals = new Meals();
        $meals->setTitle($this->faker->randomElement($mealsTitles))
            ->setCategory($refrenceCategory)
            ->addTag($refrenceTags)
            ->addIngredient($refrenceIngredients1)
            ->addIngredient($refrenceIngredients2)
            ->setDescription($this->faker->name)
            ->addTranslation($translations);
        
        // if($i%2==0){
        //     $meals->setCreatedAt($this->faker->dateTime)
        //     ->setUpdatedAt($this->faker->dateTime);
        // }
        // elseif($i%3==0){
        //     $meals->setCreatedAt($this->faker->dateTime)
        //     ->setDeletedAt($this->faker->dateTime);
        // }
            
            
        $manager->persist($meals);
        $manager->flush();
        }
        
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
