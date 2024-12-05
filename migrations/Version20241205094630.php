<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205094630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFA2B36786B ON posts (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFA989D9B62 ON posts (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_885DBAFA2B36786B ON posts');
        $this->addSql('DROP INDEX UNIQ_885DBAFA989D9B62 ON posts');
        $this->addSql('ALTER TABLE posts DROP slug');
    }
}
