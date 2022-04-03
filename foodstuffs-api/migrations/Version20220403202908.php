<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220403202908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'exclude foodstuffs to hide it to a given user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
        CREATE TABLE IF NOT EXISTS excluded_foodstuffs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ean CHAR(13)
        );');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS excluded_foodstuffs;');
    }
}
