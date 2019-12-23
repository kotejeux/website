<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223132208 extends AbstractMigration
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
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, jeu_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, paye TINYINT(1) NOT NULL, INDEX IDX_5E9E89CBA21BD112 (personne_id), INDEX IDX_5E9E89CB8C9E392E (jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_year INT DEFAULT NULL, nationalite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, editeur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, joueurs_min INT NOT NULL, joueurs_max INT NOT NULL, duree INT NOT NULL, anne INT NOT NULL, annee INT NOT NULL, INDEX IDX_82E48DB53375BD21 (editeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu_genre (jeu_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_B1B530008C9E392E (jeu_id), INDEX IDX_B1B530004296D31F (genre_id), PRIMARY KEY(jeu_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu_auteur (jeu_id INT NOT NULL, auteur_id INT NOT NULL, INDEX IDX_B60E2E6D8C9E392E (jeu_id), INDEX IDX_B60E2E6D60BB6FE6 (auteur_id), PRIMARY KEY(jeu_id, auteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB53375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE jeu_genre ADD CONSTRAINT FK_B1B530008C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_genre ADD CONSTRAINT FK_B1B530004296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_auteur ADD CONSTRAINT FK_B60E2E6D8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_auteur ADD CONSTRAINT FK_B60E2E6D60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA21BD112');
        $this->addSql('ALTER TABLE jeu_auteur DROP FOREIGN KEY FK_B60E2E6D60BB6FE6');
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB53375BD21');
        $this->addSql('ALTER TABLE jeu_genre DROP FOREIGN KEY FK_B1B530004296D31F');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB8C9E392E');
        $this->addSql('ALTER TABLE jeu_genre DROP FOREIGN KEY FK_B1B530008C9E392E');
        $this->addSql('ALTER TABLE jeu_auteur DROP FOREIGN KEY FK_B60E2E6D8C9E392E');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE jeu_genre');
        $this->addSql('DROP TABLE jeu_auteur');
    }
}
