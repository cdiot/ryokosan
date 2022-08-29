<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogsControllerTest extends WebTestCase
{
    public function testShouldDisplayContactForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/account/login-activity');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login activity');
    }
}
