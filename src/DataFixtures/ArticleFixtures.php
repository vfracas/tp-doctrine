<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $articles = ['1984', 'Les paysages d\'Amérique du Sud', 'Symfony pour les Nuls'];
        $date = new \DateTime();

        foreach ($articles as $article){
            $art = new Article();
            $art->setName($article);
            $art->setDateAjout($date);
            $art->setImage('image/no-picture.jpg');
            $manager->persist($art);
        }

        $manager->flush();
    }
}
