<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223094345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(20) NOT NULL, Prenom VARCHAR(20) DEFAULT NULL, email TEXT DEFAULT NULL, kap VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locations (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, jeu_id INT NOT NULL, date_debut DATE NOT NULL, date_fin INT NOT NULL, paye TINYINT(1) NOT NULL, INDEX date_debut (date_debut), INDEX fin_location (date_fin), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, Prenom VARCHAR(32) DEFAULT NULL, Nom INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeux (id INT AUTO_INCREMENT NOT NULL, Titre VARCHAR(32) NOT NULL, Description TEXT DEFAULT NULL, joueurs_max INT NOT NULL, joueurs_min INT NOT NULL, duree INT NOT NULL COMMENT \'en minutes\', editeur INT NOT NULL, genre INT NOT NULL, auteur INT NOT NULL, annee INT NOT NULL, INDEX Titre (Titre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(32) NOT NULL, UNIQUE INDEX genre (genre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE person');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE jeux');
        $this->addSql('DROP TABLE genre');
    }
}
