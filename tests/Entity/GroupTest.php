<?php

namespace App\Tests\Entity;

use App\Entity\Group;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public function testIsTrue()
    {
        $group = new Group();
        $createdAt = new DateTimeImmutable();
        $updateAt = new DateTime();
        $group->setName('something')
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updateAt);

        $this->assertTrue($group->getName() === 'something');
        $this->assertTrue($group->getCreatedAt() === $createdAt);
        $this->assertTrue($group->getUpdatedAt() === $updateAt);
    }

    public function testIsFalse()
    {
        $group = new Group();
        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTime();
        $group->setName('something new')
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);

        $this->assertFalse($group->getName() === 'something');
        $this->assertFalse($group->getCreatedAt() === new DateTimeImmutable('2022-09-05 00:00:00'));
        $this->assertFalse($group->getUpdatedAt() === new DateTime('2022-09-05 01:00:00'));
    }

    public function testIsEmpty()
    {
        $group = new Group();

        $this->assertEmpty($group->getName());
        $this->assertEmpty($group->getCreatedAt());
        $this->assertEmpty($group->getUpdatedAt());
    }
}
