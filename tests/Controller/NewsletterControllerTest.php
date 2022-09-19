<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsletterControllerTest extends WebTestCase
{
    public function testShouldDisplayAccount()
    {
        $client = static::createClient();
        $client->request('GET', '/newsletter');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Choose your newsletters');
    }
}
