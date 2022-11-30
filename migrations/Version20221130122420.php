<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130122420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, availability VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE name ADD fk_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE name ADD CONSTRAINT FK_5E237E06AAED72D FOREIGN KEY (fk_status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_5E237E06AAED72D ON name (fk_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE name DROP FOREIGN KEY FK_5E237E06AAED72D');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_5E237E06AAED72D ON name');
        $this->addSql('ALTER TABLE name DROP fk_status_id');
    }
}
