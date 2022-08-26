<?php

namespace App\Tests\Controller;

use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testShouldDisplayRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/registration');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create your account on Ryokosan');
    }

    public function testShouldSubmitRegisterForm()
    {
        $client = static::createClient();
        $client->request('GET', '/registration');
        $client->submitForm('Register', [
            'registration_form[gender]' => 'f',
            'registration_form[firstname]' => 'something',
            'registration_form[email]' => 'foo123@gmail.com',
            'registration_form[plainPassword]' => '123456',
            'registration_form[birthday][month]' => 10,
            'registration_form[birthday][day]' => 18,
            'registration_form[birthday][year]' => 2005,
            'registration_form[geolocalisation]' => 'GB',
            'registration_form[sponsorship]' => 'something',
            'registration_form[agreeTerms]' => true,
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
    }
}
