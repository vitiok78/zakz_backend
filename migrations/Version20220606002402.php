<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606002402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE batch (id INT AUTO_INCREMENT NOT NULL, shipment_date DATETIME NOT NULL COMMENT \'Дата багажа\', date_create DATETIME DEFAULT NULL COMMENT \'Дата создания багажа\', date_delete DATETIME DEFAULT NULL COMMENT \'Дата удаления багажа\', status SMALLINT DEFAULT NULL COMMENT \'Статус багажа\', num_batch VARCHAR(15) NOT NULL COMMENT \'Номер багажа\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE batch');
    }
}
