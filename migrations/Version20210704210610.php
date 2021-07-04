<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704210610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formateurs (id INT AUTO_INCREMENT NOT NULL, denomination_sociale VARCHAR(100) DEFAULT NULL, siret INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, tel VARCHAR(10) NOT NULL, adresse VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(5) DEFAULT NULL, ville VARCHAR(100) NOT NULL, tva DOUBLE PRECISION DEFAULT NULL, methode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateurs_formations (formateurs_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_BED037DFFB0881C8 (formateurs_id), INDEX IDX_BED037DF3BF5B0C2 (formations_id), PRIMARY KEY(formateurs_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formateurs_formations ADD CONSTRAINT FK_BED037DFFB0881C8 FOREIGN KEY (formateurs_id) REFERENCES formateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateurs_formations ADD CONSTRAINT FK_BED037DF3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formateurs_formations DROP FOREIGN KEY FK_BED037DFFB0881C8');
        $this->addSql('DROP TABLE formateurs');
        $this->addSql('DROP TABLE formateurs_formations');
    }
}
