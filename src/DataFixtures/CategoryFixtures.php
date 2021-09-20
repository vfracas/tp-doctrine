<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = '';

    public function load(ObjectManager $manager)
    {
        $categories = ['Romans', 'Beaux Livres', 'Apprentissage'];

        foreach ($categories as $category){
            $categ = new Category();
            $categ->setName($category);
            $manager->persist($categ);
        }

        $manager->flush();
    }
}
