<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706092551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opco (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, nom_contact VARCHAR(100) DEFAULT NULL, prenom_contact VARCHAR(50) DEFAULT NULL, mail VARCHAR(100) NOT NULL, tel VARCHAR(10) DEFAULT NULL, adresse VARCHAR(100) NOT NULL, ville VARCHAR(50) NOT NULL, code_postal VARCHAR(5) NOT NULL, tva DOUBLE PRECISION DEFAULT NULL, site VARCHAR(100) DEFAULT NULL, ape VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE opco');
    }
}
