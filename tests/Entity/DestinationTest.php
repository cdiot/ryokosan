<?php

namespace App\Tests;

use App\Entity\Destination;
use PHPUnit\Framework\TestCase;

class DestinationTest extends TestCase
{
    public function testIsTrue()
    {
        $destination = new Destination();

        $destination->setName('Japan');

        $this->assertTrue($destination->getName() === 'Japan');
    }

    public function testIsFalse()
    {
        $destination = new Destination();

        $destination->setName('Japon');

        $this->assertFalse($destination->getName() === 'Japan');
    }

    public function testIsEmpty()
    {
        $destination = new Destination();

        $this->assertEmpty($destination->getName());
    }
}
