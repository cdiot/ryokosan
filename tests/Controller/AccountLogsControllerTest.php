<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogsControllerTest extends WebTestCase
{
    public function testShouldDisplayUserLogs(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('foo@gmail.com');

        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/account/login-activity');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login activity');
    }
}
