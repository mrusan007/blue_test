<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\BaseFixture;
use App\Entity\Tags;


class TagsFixture extends BaseFixture
{

    private static $tagsTitles = [
    'vegeterian', '!vegeterian', 'homemade', 'foolsonly', 'fasttotoilet',
    ];

    public function loaddata(ObjectManager $manager)
    {
        $this->createMany(Tags::class, 10, function(Tags $tags, $count) {
            $tags->setTitle($this->faker->randomElement(self::$tagsTitles))
                ->setSlug($this->faker->name);
        });
        
    }
}
