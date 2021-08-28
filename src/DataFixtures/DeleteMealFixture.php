<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
use App\Entity\Meals;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class DeleteMealFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface $meals */
        $meals = $manager->getRepository(Meals::class)
                        ->findOneBy(['title'=>'cake']);
        
        $manager->persist($meals);
        // probably one should make function which deletes and changes status :)
        $manager->remove($meals);

        $manager->flush();
    }

    public function getDependencies():array
    {
        return [
            CategoriesFixture::class,
            TagsFixture::class,
            IngredientsFixture::class,
            MealsFixture::class,
        ];
    }
}
