<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325133308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD date_creation DATE NOT NULL');
        $this->addSql('ALTER TABLE commande ADD validation BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD prix DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commande DROP date_creation');
        $this->addSql('ALTER TABLE commande DROP validation');
        $this->addSql('ALTER TABLE ligne_commande DROP quantite');
        $this->addSql('ALTER TABLE ligne_commande DROP prix');
    }
}
