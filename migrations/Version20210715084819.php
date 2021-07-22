<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715084819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participants_conventions (participants_id INT NOT NULL, conventions_id INT NOT NULL, INDEX IDX_4667C1F7838709D5 (participants_id), INDEX IDX_4667C1F775019F55 (conventions_id), PRIMARY KEY(participants_id, conventions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participants_conventions ADD CONSTRAINT FK_4667C1F7838709D5 FOREIGN KEY (participants_id) REFERENCES participants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participants_conventions ADD CONSTRAINT FK_4667C1F775019F55 FOREIGN KEY (conventions_id) REFERENCES conventions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_7169709275019F55');
        $this->addSql('DROP INDEX IDX_7169709275019F55 ON participants');
        $this->addSql('ALTER TABLE participants DROP conventions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participants_conventions');
        $this->addSql('ALTER TABLE participants ADD conventions_id INT NOT NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_7169709275019F55 FOREIGN KEY (conventions_id) REFERENCES conventions (id)');
        $this->addSql('CREATE INDEX IDX_7169709275019F55 ON participants (conventions_id)');
    }
}
