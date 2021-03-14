<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311093750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD nom_etudiant VARCHAR(255) NOT NULL, ADD prenom_etudiant VARCHAR(255) NOT NULL, ADD age_etudiant INT NOT NULL, ADD arrivee_etudiant INT NOT NULL, DROP nom_e, DROP prenom_e, DROP age_e, DROP date_arrive_e');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD nom_e VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom_e VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD age_e INT NOT NULL, ADD date_arrive_e INT NOT NULL, DROP nom_etudiant, DROP prenom_etudiant, DROP age_etudiant, DROP arrivee_etudiant');
    }
}
