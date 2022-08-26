<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testShouldDisplayRequestResetPassword(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/password/request-reset');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Reset your password on Ryokosan');
    }
}
