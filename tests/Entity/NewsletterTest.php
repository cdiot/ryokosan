<?php

namespace App\Tests\Entity;

use App\Entity\Newsletter;
use PHPUnit\Framework\TestCase;

class NewsletterTest extends TestCase
{
    public function testIsTrue()
    {
        $newsletter = new Newsletter();
        $newsletter->setName('something')
            ->setContent('something')
            ->setIsSent(true);

        $this->assertTrue($newsletter->getName() === 'something');
        $this->assertTrue($newsletter->getContent() === 'something');
        $this->assertTrue($newsletter->isIsSent() === true);
    }

    public function testIsFalse()
    {
        $newsletter = new Newsletter();
        $newsletter->setName('something new')
            ->setContent('something new')
            ->setIsSent(false);

        $this->assertFalse($newsletter->getName() === 'something');
        $this->assertFalse($newsletter->getContent() === 'something');
        $this->assertFalse($newsletter->isIsSent() === true);
    }

    public function testIsEmpty()
    {
        $newsletter = new Newsletter();

        $this->assertEmpty($newsletter->getName());
        $this->assertEmpty($newsletter->getContent());
        $this->assertEmpty($newsletter->isIsSent());
    }
}
