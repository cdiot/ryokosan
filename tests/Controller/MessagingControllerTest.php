<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessagingControllerTest extends WebTestCase
{
    public function testShouldDisplayGroupIndex()
    {
        $client = static::createClient();
        // get or create the user somehow (e.g. creating some users only
        // for tests while loading the test fixtures)
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('foo@gmail.com');

        $client->loginUser($testUser);

        // user is now logged in, so you can test protected resources
        $client->request('GET', '/messaging');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Messaging');
    }

    public function testShouldDisplayNewGroupForm()
    {
        $client = static::createClient();
        // get or create the user somehow (e.g. creating some users only
        // for tests while loading the test fixtures)
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('foo@gmail.com');

        $client->loginUser($testUser);

        // user is now logged in, so you can test protected resources
        $client->request('GET', '/conversation/new');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'New conversation');
    }
}
