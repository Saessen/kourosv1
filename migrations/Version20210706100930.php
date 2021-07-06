<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706100930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, opco_id INT DEFAULT NULL, nbr_participants INT NOT NULL, tarif DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION DEFAULT NULL, date_creation DATETIME NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, duree_h INT NOT NULL, numero_devis INT NOT NULL, methode VARCHAR(255) NOT NULL, frais_annexes DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8B27C52B19EB6921 (client_id), INDEX IDX_8B27C52BCF671859 (opco_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_formations (devis_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_F0316ADF41DEFADA (devis_id), INDEX IDX_F0316ADF3BF5B0C2 (formations_id), PRIMARY KEY(devis_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B19EB6921 FOREIGN KEY (client_id) REFERENCES prospects (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BCF671859 FOREIGN KEY (opco_id) REFERENCES opco (id)');
        $this->addSql('ALTER TABLE devis_formations ADD CONSTRAINT FK_F0316ADF41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_formations ADD CONSTRAINT FK_F0316ADF3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis_formations DROP FOREIGN KEY FK_F0316ADF41DEFADA');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE devis_formations');
    }
}
