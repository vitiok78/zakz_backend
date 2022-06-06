<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606003616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batch CHANGE shipment_date shipment_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'Дата багажа\', CHANGE date_create date_create DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'Дата создания багажа\', CHANGE status status SMALLINT DEFAULT 1 COMMENT \'Статус багажа\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batch CHANGE shipment_date shipment_date DATETIME NOT NULL COMMENT \'Дата багажа\', CHANGE date_create date_create DATETIME DEFAULT NULL COMMENT \'Дата создания багажа\', CHANGE status status SMALLINT DEFAULT NULL COMMENT \'Статус багажа\'');
    }
}
