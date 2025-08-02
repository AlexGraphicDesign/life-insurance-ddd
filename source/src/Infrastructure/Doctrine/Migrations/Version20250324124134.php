<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250324124134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Supplier to Database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, rgpd VARCHAR(1000) DEFAULT NULL, rgpd_link VARCHAR(255) DEFAULT NULL, display_on_additional TINYINT(1) NOT NULL, display_on_arbitration TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE supplier');
    }
}
