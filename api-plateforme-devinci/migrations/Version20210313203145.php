<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313203145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, promotion_etudiant_id INT DEFAULT NULL, nom_etudiant VARCHAR(255) NOT NULL, prenom_etudiant VARCHAR(255) NOT NULL, age_etudiant INT NOT NULL, arrivee_etudiant INT NOT NULL, INDEX IDX_717E22E3C147879 (promotion_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, matiere_id INT DEFAULT NULL, prenom_intervenant VARCHAR(255) NOT NULL, nom_intervenant VARCHAR(255) NOT NULL, date_arrivee_intervenant INT NOT NULL, INDEX IDX_73D0145CF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, nom_cours VARCHAR(255) NOT NULL, debut_cours DATETIME NOT NULL, fin_cours DATETIME NOT NULL, UNIQUE INDEX UNIQ_9014574A139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, nom_promo VARCHAR(255) NOT NULL, date_sortie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3C147879 FOREIGN KEY (promotion_etudiant_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CF46CD258');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3C147879');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A139DF194');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE promotion');
    }
}
