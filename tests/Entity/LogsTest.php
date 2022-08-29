<?php

namespace App\Tests\Entity;

use App\Entity\Logs;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class LogsTest extends TestCase
{
    public function testIsTrue()
    {
        $logs = new Logs();
        $user = new User();
        $date = new DateTimeImmutable();
        $logs->setDate($date)
            ->setIp('127.0.0.1')
            ->setIsSuccess(true)
            ->setUser($user);

        $this->assertTrue($logs->getDate() === $date);
        $this->assertTrue($logs->getIp() === '127.0.0.1');
        $this->assertTrue($logs->isIsSuccess() === true);
        $this->assertTrue($logs->getUser() === $user);
    }

    public function testIsFalse()
    {
        $logs = new Logs();
        $user = new User();
        $date = new \DateTimeImmutable();
        $yesterday = $date->modify('-1 day');
        $logs->setDate($date)
            ->setIp('127.0.0.1')
            ->setIsSuccess(true)
            ->setUser($user);

        $this->assertFalse($logs->getDate() === $yesterday);
        $this->assertFalse($logs->getIp() === '192.168.1.1');
        $this->assertFalse($logs->isIsSuccess() === false);
        $this->assertFalse($logs->getUser() === new User());
    }
}
