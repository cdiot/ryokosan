<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();
        $category->setName('something')
            ->setSlug('something')
            ->setColor('something');

        $this->assertTrue($category->getName() === 'something');
        $this->assertTrue($category->getSlug() === 'something');
        $this->assertTrue($category->getColor() === 'something');
    }

    public function testIsFalse()
    {
        $category = new Category();
        $category->setName('something new')
            ->setSlug('something new')
            ->setColor('something new');

        $this->assertFalse($category->getName() === 'something');
        $this->assertFalse($category->getSlug() === 'something');
        $this->assertFalse($category->getColor() === 'something');
    }

    public function testIsEmpty()
    {
        $category = new Category();

        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getSlug());
        $this->assertEmpty($category->getColor());
    }
}
