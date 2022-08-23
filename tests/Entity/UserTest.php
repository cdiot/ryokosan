<?php

namespace App\Tests\Entity;

use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();
        $user->setEmail('foo@test.com')
            ->setPassword('123456')
            ->setRoles(['ROLE_USER']);



        $this->assertTrue($user->getEmail() === 'foo@test.com');
        $this->assertTrue($user->getPassword() === '123456');
        $this->assertTrue($user->getRoles() === ['ROLE_USER']);
    }

    public function testIsFalse()
    {
        $user = new User();
        $user->setEmail('bar@test.com')
            ->setPassword('azerty')
            ->setRoles(['ROLE_ADMIN']);

        $this->assertFalse($user->getEmail() === 'foo@test.com');
        $this->assertFalse($user->getPassword() === '123456');
        $this->assertFalse($user->getRoles() === ['ROLE_USER']);
    }

    public function testIsEmpty()
    {
        $user = new User();
        $user->setEmail('')
            ->setPassword('');

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
    }
}
