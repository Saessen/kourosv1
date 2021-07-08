<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708124755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conventions (id INT AUTO_INCREMENT NOT NULL, prospect_id INT NOT NULL, devis_id INT NOT NULL, lieu_formation VARCHAR(100) DEFAULT NULL, nom_participants VARCHAR(100) NOT NULL, prenom_participants VARCHAR(100) DEFAULT NULL, INDEX IDX_AC36C555D182060A (prospect_id), UNIQUE INDEX UNIQ_AC36C55541DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conventions ADD CONSTRAINT FK_AC36C555D182060A FOREIGN KEY (prospect_id) REFERENCES prospects (id)');
        $this->addSql('ALTER TABLE conventions ADD CONSTRAINT FK_AC36C55541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conventions');
    }
}
