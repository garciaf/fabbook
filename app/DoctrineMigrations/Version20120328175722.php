<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120328175722 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE Item ADD remote_id VARCHAR(26) NOT NULL ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE Item DROP remote_id, CHANGE _lastChange _lastChange DATETIME DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE checked checked TINYINT(1) DEFAULT NULL, CHANGE favorite favorite TINYINT(1) DEFAULT NULL, CHANGE onlist onlist TINYINT(1) DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL");
    }
}