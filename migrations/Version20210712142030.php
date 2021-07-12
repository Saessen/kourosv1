<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712142030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis_prospects (devis_id INT NOT NULL, prospects_id INT NOT NULL, INDEX IDX_44A0C67C41DEFADA (devis_id), INDEX IDX_44A0C67C775D63D (prospects_id), PRIMARY KEY(devis_id, prospects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis_prospects ADD CONSTRAINT FK_44A0C67C41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_prospects ADD CONSTRAINT FK_44A0C67C775D63D FOREIGN KEY (prospects_id) REFERENCES prospects (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE devis_prospects');
    }
}
