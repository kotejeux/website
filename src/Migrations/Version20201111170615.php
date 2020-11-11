<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201111170615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auteur CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE editeur CHANGE creation_year creation_year INT DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE editeur_id editeur_id INT DEFAULT NULL, CHANGE annee annee INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD nom VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(15) DEFAULT NULL, ADD ok TINYINT(1) NOT NULL, CHANGE personne_id personne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne CHANGE Prenom Prenom VARCHAR(20) DEFAULT NULL, CHANGE kap kap VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE connection_token connection_token VARCHAR(32) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auteur CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nationalite nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE editeur CHANGE creation_year creation_year INT DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jeu CHANGE editeur_id editeur_id INT DEFAULT NULL, CHANGE annee annee INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location DROP nom, DROP mail, DROP phone, DROP ok, CHANGE personne_id personne_id INT NOT NULL');
        $this->addSql('ALTER TABLE personne CHANGE Prenom Prenom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE kap kap VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE connection_token connection_token VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
