<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setUrl('image/no-picture.jpg');
        $this->addReference('no_image', $image);
        $manager->persist($image);
        $manager->flush();
    }
}
