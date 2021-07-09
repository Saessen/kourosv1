<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210709122658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, prix_ht DOUBLE PRECISION NOT NULL, prix_ttc DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_formations (prix_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_39F2E9BC944722F2 (prix_id), INDEX IDX_39F2E9BC3BF5B0C2 (formations_id), PRIMARY KEY(prix_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_devis (prix_id INT NOT NULL, devis_id INT NOT NULL, INDEX IDX_6B68AB75944722F2 (prix_id), INDEX IDX_6B68AB7541DEFADA (devis_id), PRIMARY KEY(prix_id, devis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prix_formations ADD CONSTRAINT FK_39F2E9BC944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_formations ADD CONSTRAINT FK_39F2E9BC3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_devis ADD CONSTRAINT FK_6B68AB75944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_devis ADD CONSTRAINT FK_6B68AB7541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_formations DROP FOREIGN KEY FK_39F2E9BC944722F2');
        $this->addSql('ALTER TABLE prix_devis DROP FOREIGN KEY FK_6B68AB75944722F2');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE prix_formations');
        $this->addSql('DROP TABLE prix_devis');
    }
}
