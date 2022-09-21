<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testShouldDisplayBlogIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Recent Articles');
    }

    public function testShouldDisplayOneArticle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/french-in-the-conquest-of-the-west');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'French in the conquest of the West');
    }
}
