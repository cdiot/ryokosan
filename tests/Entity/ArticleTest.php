<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use DateTime;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testIsTrue()
    {
        $article = new Article();
        $createdAt = new DateTime();
        $updatedAt = new DateTime();
        $article->setTitle('something')
            ->setContent('something')
            ->setFeaturedText('something')
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);

        $this->assertTrue($article->getCreatedAt() === $createdAt);
        $this->assertTrue($article->getUpdatedAt() === $updatedAt);
        $this->assertTrue($article->getTitle() === 'something');
        $this->assertTrue($article->getContent() === 'something');
        $this->assertTrue($article->getFeaturedText() === 'something');
    }

    public function testIsFalse()
    {
        $article = new Article();
        $createdAt = new \DateTime();
        $createdYesterday = $createdAt->modify('-1 day');
        $updatedAt = new DateTime();
        $updatedAtYesterday = $updatedAt->modify('-1 day');
        $article->setTitle('something new')
            ->setContent('something new')
            ->setFeaturedText('something new')
            ->setCreatedAt($createdYesterday)
            ->setUpdatedAt($updatedAtYesterday);

        $this->assertFalse($article->getCreatedAt() === new \DateTime());
        $this->assertFalse($article->getUpdatedAt() === new \DateTime());
        $this->assertFalse($article->getTitle() === 'something');
        $this->assertFalse($article->getContent() === 'something');
        $this->assertFalse($article->getFeaturedText() === 'something');
    }

    public function testIsEmpty()
    {
        $article = new Article();

        $this->assertEmpty($article->getCreatedAt());
        $this->assertEmpty($article->getUpdatedAt());
        $this->assertEmpty($article->getTitle());
        $this->assertEmpty($article->getContent());
        $this->assertEmpty($article->getFeaturedText());
    }
}
