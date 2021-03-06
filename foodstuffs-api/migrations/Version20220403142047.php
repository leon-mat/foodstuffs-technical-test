<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220403142047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'wishlist of users to add some foodstuffs';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
        CREATE TABLE IF NOT EXISTS wishlist_of_foodstuffs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ean CHAR(13)
        );');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS wishlist_of_foodstuffs;');
    }
}
