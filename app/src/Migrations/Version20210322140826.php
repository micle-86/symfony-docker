<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322140826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX Currency_id_base_uindex ON Currency');
        $this->addSql('ALTER TABLE Currency CHANGE id_base id_base VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(3) NOT NULL, CHANGE rate rate DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency CHANGE id_base id_base CHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE name name CHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE rate rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX Currency_id_base_uindex ON currency (id_base)');
    }
}
