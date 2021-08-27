<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\Entity\Tags;
use App\Entity\TagsTranslation;
use Gedmo\Translatable\TranslatableListener;


class TagsFixture extends Fixture
{

    private static $tagsTitles = [
    'vegeterian', '!vegeterian', 'homemade', 'foolsonly', 'fasttotoilet',
    ];

    public function load(ObjectManager $manager)
    {
        /**
        *
        * Gedmo\Translatable\TranslationListener
        */
        $tagsTran = new TagsTranslation('fr', 'title', 'morgen');
        
        $tags = new Tags();
        $tags->setTitle('food')
            ->setSlug('slug123')
            ->addTranslation($tagsTran);
        $manager->persist($tags);
        $manager->flush();
        $this->addReference('tags',$tags);

        
    }
}
