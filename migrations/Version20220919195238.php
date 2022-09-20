<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919195238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Media entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, alt_text VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD featured_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E663569D950 FOREIGN KEY (featured_image_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_23A0E663569D950 ON article (featured_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E663569D950');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP INDEX IDX_23A0E663569D950 ON article');
        $this->addSql('ALTER TABLE article DROP featured_image_id');
    }
}
