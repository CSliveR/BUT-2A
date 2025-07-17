<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407105832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id SERIAL NOT NULL, usager_id INT NOT NULL, produit_id INT NOT NULL, texte VARCHAR(255) NOT NULL, note INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67F068BC4F36F0FC ON commentaire (usager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67F068BCF347EFB ON commentaire (produit_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4F36F0FC FOREIGN KEY (usager_id) REFERENCES usager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC4F36F0FC');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCF347EFB');
        $this->addSql('DROP TABLE commentaire');
    }
}
