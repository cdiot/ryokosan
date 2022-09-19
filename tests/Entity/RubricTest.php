<?php

namespace App\Tests\Entity;

use App\Entity\Rubric;
use PHPUnit\Framework\TestCase;

class RubricTest extends TestCase
{
    public function testIsTrue()
    {
        $rubric = new Rubric();
        $rubric->setName('something');

        $this->assertTrue($rubric->getName() === 'something');
    }

    public function testIsFalse()
    {
        $rubric = new Rubric();
        $rubric->setName('something new');

        $this->assertFalse($rubric->getName() === 'something');
    }

    public function testIsEmpty()
    {
        $rubric = new Rubric();

        $this->assertEmpty($rubric->getName());
    }
}
