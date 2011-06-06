<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20110606155651 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP TABLE migration_version");
        $this->addSql("ALTER TABLE appointee CHANGE is_corporate is_corporate TINYINT(1) NOT NULL");
        $this->addSql("ALTER TABLE fos_user CHANGE roles roles LONGTEXT NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE migration_version (version INT DEFAULT NULL) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE appointee CHANGE is_corporate is_corporate TINYINT(1) DEFAULT '0' NOT NULL");
        $this->addSql("ALTER TABLE fos_user CHANGE roles roles LONGTEXT NOT NULL");
    }
}
