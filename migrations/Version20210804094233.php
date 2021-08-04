<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210804094233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conventions_participants (conventions_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_842B525975019F55 (conventions_id), INDEX IDX_842B5259838709D5 (participants_id), PRIMARY KEY(conventions_id, participants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conventions_participants ADD CONSTRAINT FK_842B525975019F55 FOREIGN KEY (conventions_id) REFERENCES conventions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conventions_participants ADD CONSTRAINT FK_842B5259838709D5 FOREIGN KEY (participants_id) REFERENCES participants (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conventions_participants');
    }
}
