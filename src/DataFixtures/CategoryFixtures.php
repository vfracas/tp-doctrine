<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['romans', 'artbooks', 'enseignement'];

        foreach ($categories as $category){
            $categ = new Category();
            $categ->setName($category);
            $manager->persist($categ);
            $this->setReference("category_".$category, $categ);
        }
        $manager->flush();
    }
}
