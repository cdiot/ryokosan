<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916132106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Destination entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity_destination (activity_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_304854A681C06096 (activity_id), INDEX IDX_304854A6816C6140 (destination_id), PRIMARY KEY(activity_id, destination_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_destination ADD CONSTRAINT FK_304854A681C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_destination ADD CONSTRAINT FK_304854A6816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_destination DROP FOREIGN KEY FK_304854A681C06096');
        $this->addSql('ALTER TABLE activity_destination DROP FOREIGN KEY FK_304854A6816C6140');
        $this->addSql('DROP TABLE activity_destination');
        $this->addSql('DROP TABLE destination');
    }
}
