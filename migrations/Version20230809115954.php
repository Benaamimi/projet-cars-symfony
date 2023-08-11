<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809115954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, membres_id INT NOT NULL, date_heure_depart DATETIME NOT NULL, date_heure_fin DATETIME NOT NULL, prix_total INT NOT NULL, date_enregistrement DATETIME NOT NULL, INDEX IDX_6EEAA67D71128C5C (membres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D71128C5C FOREIGN KEY (membres_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE vehicule ADD vehicules_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D8D8BD7E2 FOREIGN KEY (vehicules_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D8D8BD7E2 ON vehicule (vehicules_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D8D8BD7E2');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D71128C5C');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP INDEX IDX_292FFF1D8D8BD7E2 ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP vehicules_id');
    }
}
