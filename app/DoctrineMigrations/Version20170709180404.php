<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709180404 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECB39D93A');
        $this->addSql('CREATE TABLE matrix_cell (id INT AUTO_INCREMENT NOT NULL, matrix_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_240787D7AA000BE7 (matrix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matrix_item (id INT AUTO_INCREMENT NOT NULL, cell_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F09B252BCB39D93A (cell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matrix_cell ADD CONSTRAINT FK_240787D7AA000BE7 FOREIGN KEY (matrix_id) REFERENCES matrix (id)');
        $this->addSql('ALTER TABLE matrix_item ADD CONSTRAINT FK_F09B252BCB39D93A FOREIGN KEY (cell_id) REFERENCES matrix_cell (id)');
        $this->addSql('DROP TABLE cell');
        $this->addSql('DROP TABLE item');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matrix_item DROP FOREIGN KEY FK_F09B252BCB39D93A');
        $this->addSql('CREATE TABLE cell (id INT AUTO_INCREMENT NOT NULL, matrix_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_CB8787E2AA000BE7 (matrix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, cell_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_1F1B251ECB39D93A (cell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cell ADD CONSTRAINT FK_CB8787E2AA000BE7 FOREIGN KEY (matrix_id) REFERENCES matrix (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECB39D93A FOREIGN KEY (cell_id) REFERENCES cell (id)');
        $this->addSql('DROP TABLE matrix_cell');
        $this->addSql('DROP TABLE matrix_item');
    }
}
