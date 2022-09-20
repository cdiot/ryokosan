<?php

namespace App\Tests\Entity;

use App\Entity\Media;
use PHPUnit\Framework\TestCase;

class MediaTest extends TestCase
{
    public function testIsTrue()
    {
        $media = new Media();
        $media->setName('something')
            ->setFilename('something')
            ->setAltText('something');

        $this->assertTrue($media->getName() === 'something');
        $this->assertTrue($media->getFilename() === 'something');
        $this->assertTrue($media->getAltText() === 'something');
    }

    public function testIsFalse()
    {
        $media = new Media();
        $media->setName('something new')
            ->setFilename('something new')
            ->setAltText('something new');

        $this->assertFalse($media->getName() === 'something');
        $this->assertFalse($media->getFilename() === 'something');
        $this->assertFalse($media->getAltText() === 'something');
    }

    public function testIsEmpty()
    {
        $media = new Media();

        $this->assertEmpty($media->getName());
        $this->assertEmpty($media->getFilename());
        $this->assertEmpty($media->getAltText());
    }
}
