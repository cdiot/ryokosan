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
        $birthday = new DateTimeImmutable('2008-01-01');
        $user->setEmail('foo@test.com')
            ->setPassword('123456')
            ->setRoles(['ROLE_USER'])
            ->setGender('m')
            ->setUsername('something')
            ->setBirthday($birthday)
            ->setGeolocalisation('FR')
            ->setSponsorship('something')
            ->setIsVerified(true)
            ->setBio('something');



        $this->assertTrue($user->getEmail() === 'foo@test.com');
        $this->assertTrue($user->getPassword() === '123456');
        $this->assertTrue($user->getRoles() === ['ROLE_USER']);
        $this->assertTrue($user->getGender() === 'm');
        $this->assertTrue($user->getUsername() === 'something');
        $this->assertTrue($user->getBirthday() === $birthday);
        $this->assertTrue($user->getGeolocalisation() === 'FR');
        $this->assertTrue($user->getSponsorship() === 'something');
        $this->assertTrue($user->isVerified() === true);
        $this->assertTrue($user->getBio() === 'something');
    }

    public function testIsFalse()
    {
        $user = new User();
        $birthday1 = new DateTimeImmutable('2008-01-01');
        $birthday2 = new DateTimeImmutable('2007-01-01');
        $user->setEmail('bar@test.com')
            ->setPassword('azerty')
            ->setRoles(['ROLE_ADMIN'])
            ->setGender('f')
            ->setUsername('something new')
            ->setBirthday($birthday2)
            ->setGeolocalisation('EN')
            ->setSponsorship('something new')
            ->setIsVerified(false)
            ->setBio('something new');

        $this->assertFalse($user->getEmail() === 'foo@test.com');
        $this->assertFalse($user->getPassword() === '123456');
        $this->assertFalse($user->getRoles() === ['ROLE_USER']);
        $this->assertFalse($user->getGender() === 'm');
        $this->assertFalse($user->getUsername() === 'something');
        $this->assertFalse($user->getBirthday() === $birthday1);
        $this->assertFalse($user->getGeolocalisation() === 'FR');
        $this->assertFalse($user->getSponsorship() === 'something');
        $this->assertFalse($user->isVerified() === true);
        $this->assertFalse($user->getSponsorship() === 'something');
        $this->assertFalse($user->getBio() === 'something');
    }

    public function testIsEmpty()
    {
        $user = new User();
        $user->setEmail('')
            ->setPassword('')
            ->setGender('')
            ->setUsername('')
            ->setGeolocalisation('')
            ->setSponsorship('')
            ->setIsVerified('')
            ->setBio('');

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getGender());
        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getGeolocalisation());
        $this->assertEmpty($user->getSponsorship());
        $this->assertEmpty($user->isVerified());
        $this->assertEmpty($user->getBio());
    }
}
