<?php


namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var User $user */
        $user = $this->getReference('user');

        $article = (new Article())
            ->setTitle('Mon Super Title')
            ->setSubtitle('Mon Super Subtitle')
            ->setContent('Mon Super Content')
            ->setAuthor($user)
        ;

        $manager->persist($article);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}