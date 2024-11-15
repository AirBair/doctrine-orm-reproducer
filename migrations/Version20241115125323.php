<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241115125323 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dummy_child (id INT AUTO_INCREMENT NOT NULL, dummy_parent_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1D9145FDD77C46E4 (dummy_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dummy_parent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dummy_child ADD CONSTRAINT FK_1D9145FDD77C46E4 FOREIGN KEY (dummy_parent_id) REFERENCES dummy_parent (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dummy_child DROP FOREIGN KEY FK_1D9145FDD77C46E4');
        $this->addSql('DROP TABLE dummy_child');
        $this->addSql('DROP TABLE dummy_parent');
    }
}
