<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120418185619 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE ArticleBlog ADD author_id INT DEFAULT NULL, DROP author");
        $this->addSql("ALTER TABLE ArticleBlog ADD CONSTRAINT FK_39CF4B2AF675F31B FOREIGN KEY (author_id) REFERENCES fos_user(id)");
        $this->addSql("CREATE INDEX IDX_39CF4B2AF675F31B ON ArticleBlog (author_id)");
        $this->addSql("ALTER TABLE Article ADD author_id INT DEFAULT NULL, DROP author");
        $this->addSql("ALTER TABLE Article ADD CONSTRAINT FK_CD8737FAF675F31B FOREIGN KEY (author_id) REFERENCES fos_user(id)");
        $this->addSql("CREATE INDEX IDX_CD8737FAF675F31B ON Article (author_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FAF675F31B");
        $this->addSql("DROP INDEX IDX_CD8737FAF675F31B ON Article");
        $this->addSql("ALTER TABLE Article ADD author VARCHAR(255) NOT NULL, DROP author_id");
        $this->addSql("ALTER TABLE ArticleBlog DROP FOREIGN KEY FK_39CF4B2AF675F31B");
        $this->addSql("DROP INDEX IDX_39CF4B2AF675F31B ON ArticleBlog");
        $this->addSql("ALTER TABLE ArticleBlog ADD author VARCHAR(255) NOT NULL, DROP author_id");
    }
}
