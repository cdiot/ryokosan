<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918191853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Rubric entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rubric (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newsletter ADD rubrics_id INT NOT NULL');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C853D89DD2 FOREIGN KEY (rubrics_id) REFERENCES rubric (id)');
        $this->addSql('CREATE INDEX IDX_7E8585C853D89DD2 ON newsletter (rubrics_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C853D89DD2');
        $this->addSql('DROP TABLE rubric');
        $this->addSql('DROP INDEX IDX_7E8585C853D89DD2 ON newsletter');
        $this->addSql('ALTER TABLE newsletter DROP rubrics_id');
    }
}
