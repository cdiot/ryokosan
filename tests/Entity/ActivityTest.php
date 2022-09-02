<?php

namespace App\Tests\Entity;

use App\Entity\Activity;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    public function testIsTrue()
    {
        $activity = new Activity();
        $createdAt = new DateTimeImmutable();
        $startDate = new DateTimeImmutable();
        $endDate = new DateTimeImmutable();
        $user = new User();
        $activity->setCreatedAt($createdAt)
            ->setStartDate($startDate)
            ->setEndDate($endDate)
            ->setDescription('something')
            ->setUser($user);

        $this->assertTrue($activity->getCreatedAt() === $createdAt);
        $this->assertTrue($activity->getStartDate() === $startDate);
        $this->assertTrue($activity->getEndDate() === $endDate);
        $this->assertTrue($activity->getDescription() === 'something');
        $this->assertTrue($activity->getUser() === $user);
    }

    public function testIsFalse()
    {
        $activity = new Activity();
        $createdAt = new \DateTimeImmutable();
        $createdYesterday = $createdAt->modify('-1 day');
        $startDate1 = new DateTimeImmutable();
        $startDate2 = $startDate1->modify('-1 day');
        $endDate1 = new DateTimeImmutable();
        $endDate2 = $endDate1->modify('-1 day');
        $user = new User();
        $activity->setCreatedAt($createdAt)
            ->setStartDate($startDate2)
            ->setEndDate($endDate2)
            ->setDescription('something new')
            ->setUser($user);

        $this->assertFalse($activity->getCreatedAt() === $createdYesterday);
        $this->assertFalse($activity->getStartDate() === $startDate1);
        $this->assertFalse($activity->getEndDate() === $endDate1);
        $this->assertFalse($activity->getDescription() === 'something');
        $this->assertNotSame(new User(), $activity->getUser());
    }

    public function testIsEmpty()
    {
        $activity = new Activity();

        $this->assertEmpty($activity->getCreatedAt());
        $this->assertEmpty($activity->getStartDate());
        $this->assertEmpty($activity->getEndDate());
        $this->assertEmpty($activity->getDescription());
        $this->assertEmpty($activity->getUser());
    }
}
