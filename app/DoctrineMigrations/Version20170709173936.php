<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709173936 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER DATABASE '.$this->connection->getDatabase().' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER DATABASE '.$this->connection->getDatabase().' CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci;');
    }
}
