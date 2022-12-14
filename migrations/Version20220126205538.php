<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126205538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD surface INT NOT NULL, ADD chambres INT NOT NULL, ADD pieces INT NOT NULL, ADD etage INT NOT NULL, ADD prix INT NOT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD code_postal VARCHAR(255) DEFAULT NULL, ADD vendue TINYINT(1) DEFAULT \'0\' NOT NULL, ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP surface, DROP chambres, DROP pieces, DROP etage, DROP prix, DROP city, DROP adresse, DROP code_postal, DROP vendue, DROP created_at');
    }
}
