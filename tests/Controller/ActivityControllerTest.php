<?php

namespace App\Test\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActivityControllerTest extends WebTestCase
{
    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testShouldDisplayActivityIndex(): void
    {
        $crawler = $this->client->request('GET', '/activity');

        self::assertResponseStatusCodeSame(200);
        self::assertSelectorTextContains('h1', 'Activity Feed from the community');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testShouldDisplayNewActivityForm()
    {
        // get or create the user somehow (e.g. creating some users only
        // for tests while loading the test fixtures)
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('foo@gmail.com');

        $this->client->loginUser($testUser);
        // user is now logged in, so you can test protected resources
        $crawler = $this->client->request('GET', '/activity/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create new Activity');
    }
}
