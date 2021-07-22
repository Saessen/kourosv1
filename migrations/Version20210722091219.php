<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722091219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conventions (id INT AUTO_INCREMENT NOT NULL, prospect_id INT NOT NULL, devis_id INT NOT NULL, lieu_formation VARCHAR(100) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_AC36C555D182060A (prospect_id), UNIQUE INDEX UNIQ_AC36C55541DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_prospects (devis_id INT NOT NULL, prospects_id INT NOT NULL, INDEX IDX_44A0C67C41DEFADA (devis_id), INDEX IDX_44A0C67C775D63D (prospects_id), PRIMARY KEY(devis_id, prospects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, conventions_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, INDEX IDX_71697092A4AEAFEA (entreprise_id), INDEX IDX_7169709275019F55 (conventions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, prix_ht DOUBLE PRECISION NOT NULL, prix_ttc DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_formations (prix_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_39F2E9BC944722F2 (prix_id), INDEX IDX_39F2E9BC3BF5B0C2 (formations_id), PRIMARY KEY(prix_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_devis (prix_id INT NOT NULL, devis_id INT NOT NULL, INDEX IDX_6B68AB75944722F2 (prix_id), INDEX IDX_6B68AB7541DEFADA (devis_id), PRIMARY KEY(prix_id, devis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id INT AUTO_INCREMENT NOT NULL, texte LONGTEXT DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_formations (template_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_625B64F85DA0FB8 (template_id), INDEX IDX_625B64F83BF5B0C2 (formations_id), PRIMARY KEY(template_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conventions ADD CONSTRAINT FK_AC36C555D182060A FOREIGN KEY (prospect_id) REFERENCES prospects (id)');
        $this->addSql('ALTER TABLE conventions ADD CONSTRAINT FK_AC36C55541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE devis_prospects ADD CONSTRAINT FK_44A0C67C41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_prospects ADD CONSTRAINT FK_44A0C67C775D63D FOREIGN KEY (prospects_id) REFERENCES prospects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_7169709275019F55 FOREIGN KEY (conventions_id) REFERENCES conventions (id)');
        $this->addSql('ALTER TABLE prix_formations ADD CONSTRAINT FK_39F2E9BC944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_formations ADD CONSTRAINT FK_39F2E9BC3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_devis ADD CONSTRAINT FK_6B68AB75944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_devis ADD CONSTRAINT FK_6B68AB7541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE template_formations ADD CONSTRAINT FK_625B64F85DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE template_formations ADD CONSTRAINT FK_625B64F83BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_7169709275019F55');
        $this->addSql('ALTER TABLE prix_formations DROP FOREIGN KEY FK_39F2E9BC944722F2');
        $this->addSql('ALTER TABLE prix_devis DROP FOREIGN KEY FK_6B68AB75944722F2');
        $this->addSql('ALTER TABLE template_formations DROP FOREIGN KEY FK_625B64F85DA0FB8');
        $this->addSql('DROP TABLE conventions');
        $this->addSql('DROP TABLE devis_prospects');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE prix_formations');
        $this->addSql('DROP TABLE prix_devis');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE template_formations');
    }
}
