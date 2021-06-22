<?php


namespace App\Tests\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ArticleControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ?UserRepository $userRepository;
    private ?ArticleRepository $articleRepository;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->userRepository = static::$container->get(UserRepository::class);
        $this->articleRepository = static::$container->get(ArticleRepository::class);
    }

    public function testIndexPage() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('GET', '/articles');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Liste des articles');
    }

    public function testNewPage() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('GET', '/articles/new');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Ajouter un article');
    }

    public function testPostArticle() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $article = (new Article())
            ->setTitle('Mon Super Title')
            ->setSubtitle('Mon Super Subtitle')
            ->setContent('Mon Super Content');

        $this->client->request('POST', '/articles/new', [], [], [], json_encode($article));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testShowPage() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);
        $article = $this->articleRepository->findAll()[0];

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('GET', '/articles/' . $article->getId());
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', $article->getTitle());
    }

    public function testEditPage() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);
        $article = $this->articleRepository->findAll()[0];

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('GET', '/articles/' . $article->getId() . '/edit');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Editer un article');
    }

    public function testDeleteArticleFromUser() {
        $user = $this->userRepository->findOneBy(['email' => 'user@contact.com']);
        $article = $this->articleRepository->findAll()[0];

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('POST', '/articles/' . $article->getId());
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testDeleteArticleFromAdmin() {
        $user = $this->userRepository->findOneBy(['email' => 'admin@contact.com']);
        $article = $this->articleRepository->findAll()[0];

        $this->client->followRedirects();
        $this->client->loginUser($user);

        $this->client->request('POST', '/articles/' . $article->getId());
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}