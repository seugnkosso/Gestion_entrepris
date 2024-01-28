<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128103915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE point (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_user (point_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_413312BC028CEA2 (point_id), INDEX IDX_413312BA76ED395 (user_id), PRIMARY KEY(point_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE point_user ADD CONSTRAINT FK_413312BC028CEA2 FOREIGN KEY (point_id) REFERENCES point (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE point_user ADD CONSTRAINT FK_413312BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dd ADD point_id INT NOT NULL');
        $this->addSql('ALTER TABLE dd ADD CONSTRAINT FK_A97191DC028CEA2 FOREIGN KEY (point_id) REFERENCES point (id)');
        $this->addSql('CREATE INDEX IDX_A97191DC028CEA2 ON dd (point_id)');
        $this->addSql('ALTER TABLE frais ADD point_id INT NOT NULL');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98C028CEA2 FOREIGN KEY (point_id) REFERENCES point (id)');
        $this->addSql('CREATE INDEX IDX_25404C98C028CEA2 ON frais (point_id)');
        $this->addSql('ALTER TABLE produit ADD point_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C028CEA2 FOREIGN KEY (point_id) REFERENCES point (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C028CEA2 ON produit (point_id)');
        $this->addSql('ALTER TABLE vc ADD point_id INT NOT NULL');
        $this->addSql('ALTER TABLE vc ADD CONSTRAINT FK_EC07FC6DC028CEA2 FOREIGN KEY (point_id) REFERENCES point (id)');
        $this->addSql('CREATE INDEX IDX_EC07FC6DC028CEA2 ON vc (point_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dd DROP FOREIGN KEY FK_A97191DC028CEA2');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98C028CEA2');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C028CEA2');
        $this->addSql('ALTER TABLE vc DROP FOREIGN KEY FK_EC07FC6DC028CEA2');
        $this->addSql('ALTER TABLE point_user DROP FOREIGN KEY FK_413312BC028CEA2');
        $this->addSql('ALTER TABLE point_user DROP FOREIGN KEY FK_413312BA76ED395');
        $this->addSql('DROP TABLE point');
        $this->addSql('DROP TABLE point_user');
        $this->addSql('DROP INDEX IDX_A97191DC028CEA2 ON dd');
        $this->addSql('ALTER TABLE dd DROP point_id');
        $this->addSql('DROP INDEX IDX_25404C98C028CEA2 ON frais');
        $this->addSql('ALTER TABLE frais DROP point_id');
        $this->addSql('DROP INDEX IDX_29A5EC27C028CEA2 ON produit');
        $this->addSql('ALTER TABLE produit DROP point_id');
        $this->addSql('DROP INDEX IDX_EC07FC6DC028CEA2 ON vc');
        $this->addSql('ALTER TABLE vc DROP point_id');
    }
}
