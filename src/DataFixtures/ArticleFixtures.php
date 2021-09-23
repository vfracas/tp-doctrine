<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $articles = ['1984', 'Les paysages d\'Amérique du Sud', 'Symfony pour les Nuls'];
        $date = new \DateTime();
        $categories = ['category_romans', 'category_artbooks', 'category_enseignement'];
        $i = 0;

        foreach ($articles as $article){
            $art = new Article();
            $art->setName($article);
            $art->setDateAjout($date);
            $art->addImage($this->getReference('no_image'));
            $art->setCategory($this->getReference($categories[$i]));
            $i++;
            $manager->persist($art);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ImageFixtures::class
        ];
    }
}
