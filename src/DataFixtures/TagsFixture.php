<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\Entity\Tags;
use App\Entity\TagsTranslation;
use Gedmo\Translatable\TranslatableListener;
use Faker\Factory;

class TagsFixture extends Fixture
{

    protected $faker;

    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */
        $tagsTitles = [
            'vegeterian', '!vegeterian', 'homemade', 'foolsonly', 'fasttotoilet',
            ];
        $this->faker = Factory::create();
        for($i=0;$i<count($tagsTitles);$i++){

            
            $translations = array(new TagsTranslation('es', 'title', "translate_es_$i"),
                new TagsTranslation('fr', 'title', "translate_fr_$i")
        );
           

            $tags = new Tags();
            $tags->setTitle($tagsTitles[$i])
                ->setSlug($this->faker->name)
                ->addTranslation($translations);
            $manager->persist($tags);
            $manager->flush();
            $this->addReference("tags_$i",$tags);
        }
        
    }
}
