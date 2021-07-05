<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705145035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prospects DROP clients_id, DROP clients_nom_id, DROP clients_prenom_id, DROP clients_mail_id, DROP clients_adresse_id, DROP clients_cp_id, DROP clients_ville_id, DROP clients_site_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prospects ADD clients_id INT NOT NULL, ADD clients_nom_id INT NOT NULL, ADD clients_prenom_id INT DEFAULT NULL, ADD clients_mail_id INT DEFAULT NULL, ADD clients_adresse_id INT DEFAULT NULL, ADD clients_cp_id INT DEFAULT NULL, ADD clients_ville_id INT NOT NULL, ADD clients_site_id INT DEFAULT NULL');
    }
}
