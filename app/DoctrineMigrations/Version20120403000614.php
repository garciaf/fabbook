<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120403000614 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE Portrait (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(255) NOT NULL, createdAt DATE DEFAULT NULL, PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE fos_user ADD portrait_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE fos_user ADD CONSTRAINT FK_957A64791226EBF3 FOREIGN KEY (portrait_id) REFERENCES Portrait(id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_957A64791226EBF3 ON fos_user (portrait_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64791226EBF3");
        $this->addSql("DROP TABLE Portrait");
        $this->addSql("ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64791226EBF3");
        $this->addSql("DROP INDEX UNIQ_957A64791226EBF3 ON fos_user");
        $this->addSql("ALTER TABLE fos_user DROP portrait_id");
    }
}