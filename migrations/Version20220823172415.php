<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823172415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add gender, firstname, birthday, geolocalisation, sponsorship in user entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD gender VARCHAR(2) NOT NULL, ADD firstname VARCHAR(50) NOT NULL, ADD birthday DATE NOT NULL, ADD geolocalisation VARCHAR(2) NOT NULL, ADD sponsorship VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP gender, DROP firstname, DROP birthday, DROP geolocalisation, DROP sponsorship');
    }
}
