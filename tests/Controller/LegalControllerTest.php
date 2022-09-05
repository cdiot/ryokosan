<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LegalControllerTest extends WebTestCase
{
    public function testShouldDisplayPrivacy(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/privacy-policy');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Privacy Policy');
    }

    public function testShouldDisplayTerms(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/general-terms-and-conditions-of-use');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Terms of Use');
    }
}
