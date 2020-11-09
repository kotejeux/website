<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201108234606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, connection_token VARCHAR(32) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64999FD688E (connection_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE editeur CHANGE creation_year creation_year INT DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE editeur_id editeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne CHANGE Prenom Prenom VARCHAR(20) DEFAULT NULL, CHANGE kap kap VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE auteur CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nationalite nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE editeur CHANGE creation_year creation_year INT DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jeu CHANGE editeur_id editeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne CHANGE Prenom Prenom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE kap kap VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
