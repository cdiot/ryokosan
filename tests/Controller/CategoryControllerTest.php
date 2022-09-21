<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testShouldDisplayHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category/travel-stories');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Travel stories');
    }
}
