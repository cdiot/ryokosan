<?php

namespace App\Tests\Entity;

use App\Entity\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberTest extends TestCase
{
    public function testIsTrue()
    {
        $subscriber = new Subscriber();
        $subscriber->setEmail('foo@gmail.com')
            ->setIsRgpd(true)
            ->setValidationToken('something')
            ->setIsValid(true);

        $this->assertTrue($subscriber->getEmail() === 'foo@gmail.com');
        $this->assertTrue($subscriber->isIsRgpd() === true);
        $this->assertTrue($subscriber->getValidationToken() === 'something');
        $this->assertTrue($subscriber->isIsValid() === true);
    }

    public function testIsFalse()
    {
        $subscriber = new Subscriber();
        $subscriber->setEmail('bar@gmail.com')
            ->setIsRgpd(true)
            ->setValidationToken('something new')
            ->setIsValid(false);

        $this->assertFalse($subscriber->getEmail() === 'foo@gmail.com');
        $this->assertFalse($subscriber->isIsRgpd() === true);
        $this->assertFalse($subscriber->getValidationToken() === 'something');
        $this->assertFalse($subscriber->isIsValid() === true);
    }

    public function testIsEmpty()
    {
        $subscriber = new Subscriber();

        $this->assertEmpty($subscriber->getEmail());
        $this->assertEmpty($subscriber->isIsRgpd());
        $this->assertEmpty($subscriber->getValidationToken());
        $this->assertEmpty($subscriber->isIsValid());
    }
}
