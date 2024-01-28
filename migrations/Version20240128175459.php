<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128175459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caisse ADD point_id INT NOT NULL');
        $this->addSql('ALTER TABLE caisse ADD CONSTRAINT FK_B2A353C8C028CEA2 FOREIGN KEY (point_id) REFERENCES point (id)');
        $this->addSql('CREATE INDEX IDX_B2A353C8C028CEA2 ON caisse (point_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caisse DROP FOREIGN KEY FK_B2A353C8C028CEA2');
        $this->addSql('DROP INDEX IDX_B2A353C8C028CEA2 ON caisse');
        $this->addSql('ALTER TABLE caisse DROP point_id');
    }
}
