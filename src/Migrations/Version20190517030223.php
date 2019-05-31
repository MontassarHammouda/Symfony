<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190517030223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, urls LONGTEXT NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_E418C74D1FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice_compte_rendue (exercice_id INT NOT NULL, compte_rendue_id INT NOT NULL, INDEX IDX_23AB698C89D40298 (exercice_id), INDEX IDX_23AB698C8FFF6148 (compte_rendue_id), PRIMARY KEY(exercice_id, compte_rendue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, email VARCHAR(255) DEFAULT NULL, image_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_rendue (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, description VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_87D457CBDDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, profs_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, decription LONGTEXT NOT NULL, INDEX IDX_9014574ABDDFA3C9 (profs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, urls LONGTEXT DEFAULT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_8C62B025F46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numtel VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5BBA70BBE7927C74 (email), UNIQUE INDEX UNIQ_5BBA70BBF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE exercice_compte_rendue ADD CONSTRAINT FK_23AB698C89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_compte_rendue ADD CONSTRAINT FK_23AB698C8FFF6148 FOREIGN KEY (compte_rendue_id) REFERENCES compte_rendue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte_rendue ADD CONSTRAINT FK_87D457CBDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574ABDDFA3C9 FOREIGN KEY (profs_id) REFERENCES prof (id)');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B025F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exercice_compte_rendue DROP FOREIGN KEY FK_23AB698C89D40298');
        $this->addSql('ALTER TABLE compte_rendue DROP FOREIGN KEY FK_87D457CBDDEAB1A3');
        $this->addSql('ALTER TABLE exercice_compte_rendue DROP FOREIGN KEY FK_23AB698C8FFF6148');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B025F46CD258');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D1FBEEF7B');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574ABDDFA3C9');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE exercice_compte_rendue');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE compte_rendue');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE prof');
    }
}
