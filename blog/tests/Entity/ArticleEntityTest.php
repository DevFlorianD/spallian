<?php


namespace App\Tests\Entity;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleEntityTest extends KernelTestCase
{
    private function getEntity() {
        return (new Article())
            ->setTitle('Mon Super Title')
            ->setSubtitle('Mon Super Subtitle')
            ->setContent('Mon Super Content');
    }

    public function testValidEntity() {
        $article = $this->getEntity();

        self::bootKernel();
        $error = static::$container->get('validator')->validate($article);
        $this->assertCount(0, $error);
    }

    public function testNonValidEntity() {
        $article = $this->getEntity()->setTitle('');

        self::bootKernel();
        $error = static::$container->get('validator')->validate($article);
        $this->assertCount(1, $error);
    }

    public function testBlankTitleEntity() {
        $article = $this->getEntity()->setTitle('');

        self::bootKernel();
        $error = static::$container->get('validator')->validate($article);
        $this->assertCount(1, $error);
    }

    public function testBlankContentEntity() {
        $article = $this->getEntity()->setContent('');

        self::bootKernel();
        $error = static::$container->get('validator')->validate($article);
        $this->assertCount(1, $error);
    }
}