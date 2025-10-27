<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251021231344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuarios ADD roles JSON NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE status status INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF687F2E7927C74 ON usuarios (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_EF687F2E7927C74 ON usuarios');
        $this->addSql('ALTER TABLE usuarios DROP roles, CHANGE password password VARCHAR(120) NOT NULL, CHANGE status status INT DEFAULT 1 NOT NULL');
    }
}
