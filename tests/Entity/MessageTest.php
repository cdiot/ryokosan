<?php

namespace App\Tests\Entity;

use App\Entity\Message;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testIsTrue()
    {
        $message = new Message();
        $user = new User();
        $createdAt = new DateTimeImmutable();
        $message->setMessage('something')
            ->setCreatedAt($createdAt)
            ->setUser($user);

        $this->assertTrue($message->getMessage() === 'something');
        $this->assertTrue($message->getCreatedAt() === $createdAt);
        $this->assertTrue($message->getUser() === $user);
    }

    public function testIsFalse()
    {
        $message = new Message();
        $user = new User();
        $createdAt = new \DateTimeImmutable();
        $createdYesterday = $createdAt->modify('-1 day');
        $message->setMessage('something new')
            ->setCreatedAt($createdAt)
            ->setUser($user);

        $this->assertFalse($message->getMessage() === 'something');
        $this->assertFalse($message->getCreatedAt() === $createdYesterday);
        $this->assertNotSame(new User(), $message->getUser());
    }

    public function testIsEmpty()
    {
        $message = new Message();

        $this->assertEmpty($message->getMessage());
        $this->assertEmpty($message->getCreatedAt());
        $this->assertEmpty($message->getUser());
    }
}
