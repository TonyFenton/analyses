<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170711194548 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE matrix_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_635E571C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matrix ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matrix ADD CONSTRAINT FK_F83341CFC54C8C93 FOREIGN KEY (type_id) REFERENCES matrix_type (id)');
        $this->addSql('CREATE INDEX IDX_F83341CFC54C8C93 ON matrix (type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matrix DROP FOREIGN KEY FK_F83341CFC54C8C93');
        $this->addSql('DROP TABLE matrix_type');
        $this->addSql('DROP INDEX IDX_F83341CFC54C8C93 ON matrix');
        $this->addSql('ALTER TABLE matrix DROP type_id');
    }
}
