<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709172834 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cell (id INT AUTO_INCREMENT NOT NULL, matrix_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CB8787E2AA000BE7 (matrix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, cell_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1F1B251ECB39D93A (cell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matrix (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F83341CFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_content (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, header VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_4A5DB3CC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_description (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, description VARCHAR(500) NOT NULL, UNIQUE INDEX UNIQ_7A581E54C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, route VARCHAR(100) NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_140AB6202C42079 (route), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cell ADD CONSTRAINT FK_CB8787E2AA000BE7 FOREIGN KEY (matrix_id) REFERENCES matrix (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECB39D93A FOREIGN KEY (cell_id) REFERENCES cell (id)');
        $this->addSql('ALTER TABLE matrix ADD CONSTRAINT FK_F83341CFA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE page_content ADD CONSTRAINT FK_4A5DB3CC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page_description ADD CONSTRAINT FK_7A581E54C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECB39D93A');
        $this->addSql('ALTER TABLE cell DROP FOREIGN KEY FK_CB8787E2AA000BE7');
        $this->addSql('ALTER TABLE page_content DROP FOREIGN KEY FK_4A5DB3CC4663E4');
        $this->addSql('ALTER TABLE page_description DROP FOREIGN KEY FK_7A581E54C4663E4');
        $this->addSql('ALTER TABLE matrix DROP FOREIGN KEY FK_F83341CFA76ED395');
        $this->addSql('DROP TABLE cell');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE matrix');
        $this->addSql('DROP TABLE page_content');
        $this->addSql('DROP TABLE page_description');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE fos_user');
    }
}
