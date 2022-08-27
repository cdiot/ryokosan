<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testShouldDisplayContactForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact-us');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contact us on Ryokosan');
    }

    public function testShouldSubmitContactForm()
    {
        $client = static::createClient();
        $client->request('GET', '/contact-us');

        $client->submitForm('Send', [
            'contact[email]' => 'foo@gmail.com',
            'contact[subject]' => 'something',
            'contact[content]' => 'something'
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
    }
}
