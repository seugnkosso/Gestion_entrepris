<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107220226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caisse (id INT AUTO_INCREMENT NOT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', total_frais DOUBLE PRECISION NOT NULL, total_vente DOUBLE PRECISION NOT NULL, total_dette_payer DOUBLE PRECISION NOT NULL, total_dus_payer DOUBLE PRECISION NOT NULL, total_commande DOUBLE PRECISION NOT NULL, benefice DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dd (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', montant_total DOUBLE PRECISION NOT NULL, montant_restant DOUBLE PRECISION NOT NULL, montant_donnee DOUBLE PRECISION NOT NULL, client VARCHAR(255) NOT NULL, type_dd VARCHAR(10) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_vc (id INT AUTO_INCREMENT NOT NULL, v_c_id INT NOT NULL, produit_id INT NOT NULL, dette_par_vente_id INT DEFAULT NULL, prix_vente DOUBLE PRECISION NOT NULL, qte_vente INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, INDEX IDX_8BEE9886666953AA (v_c_id), INDEX IDX_8BEE9886F347EFB (produit_id), INDEX IDX_8BEE98865F62F3A5 (dette_par_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dette (id INT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_831BC808A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dette_par_vente (id INT NOT NULL, user_id INT DEFAULT NULL, benefice DOUBLE PRECISION NOT NULL, benef_complet TINYINT(1) NOT NULL, INDEX IDX_7174C84A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE due (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, montant DOUBLE PRECISION NOT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payement (id INT AUTO_INCREMENT NOT NULL, dd_id INT DEFAULT NULL, dette_par_vente_id INT DEFAULT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', numero VARCHAR(255) NOT NULL, montant_verser DOUBLE PRECISION NOT NULL, INDEX IDX_B20A788587D45AE6 (dd_id), INDEX IDX_B20A78855F62F3A5 (dette_par_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, detail VARCHAR(255) NOT NULL, qte INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, prix_vente_fix DOUBLE PRECISION NOT NULL, prix_vente_min DOUBLE PRECISION NOT NULL, categorie VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superviseur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom_complet VARCHAR(50) NOT NULL, telephone VARCHAR(9) NOT NULL, is_archived TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vc (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', total DOUBLE PRECISION NOT NULL, client VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_EC07FC6DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DBF396750 FOREIGN KEY (id) REFERENCES vc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_vc ADD CONSTRAINT FK_8BEE9886666953AA FOREIGN KEY (v_c_id) REFERENCES vc (id)');
        $this->addSql('ALTER TABLE detail_vc ADD CONSTRAINT FK_8BEE9886F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detail_vc ADD CONSTRAINT FK_8BEE98865F62F3A5 FOREIGN KEY (dette_par_vente_id) REFERENCES dette_par_vente (id)');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC808A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC808BF396750 FOREIGN KEY (id) REFERENCES dd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dette_par_vente ADD CONSTRAINT FK_7174C84A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE dette_par_vente ADD CONSTRAINT FK_7174C84BF396750 FOREIGN KEY (id) REFERENCES dd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE due ADD CONSTRAINT FK_DF0FA28ABF396750 FOREIGN KEY (id) REFERENCES dd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A788587D45AE6 FOREIGN KEY (dd_id) REFERENCES dd (id)');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A78855F62F3A5 FOREIGN KEY (dette_par_vente_id) REFERENCES dette_par_vente (id)');
        $this->addSql('ALTER TABLE superviseur ADD CONSTRAINT FK_9DF40730BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vc ADD CONSTRAINT FK_EC07FC6DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CBF396750 FOREIGN KEY (id) REFERENCES vc (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DBF396750');
        $this->addSql('ALTER TABLE detail_vc DROP FOREIGN KEY FK_8BEE9886666953AA');
        $this->addSql('ALTER TABLE detail_vc DROP FOREIGN KEY FK_8BEE9886F347EFB');
        $this->addSql('ALTER TABLE detail_vc DROP FOREIGN KEY FK_8BEE98865F62F3A5');
        $this->addSql('ALTER TABLE dette DROP FOREIGN KEY FK_831BC808A76ED395');
        $this->addSql('ALTER TABLE dette DROP FOREIGN KEY FK_831BC808BF396750');
        $this->addSql('ALTER TABLE dette_par_vente DROP FOREIGN KEY FK_7174C84A76ED395');
        $this->addSql('ALTER TABLE dette_par_vente DROP FOREIGN KEY FK_7174C84BF396750');
        $this->addSql('ALTER TABLE due DROP FOREIGN KEY FK_DF0FA28ABF396750');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A788587D45AE6');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A78855F62F3A5');
        $this->addSql('ALTER TABLE superviseur DROP FOREIGN KEY FK_9DF40730BF396750');
        $this->addSql('ALTER TABLE vc DROP FOREIGN KEY FK_EC07FC6DA76ED395');
        $this->addSql('ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF49996BF396750');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CBF396750');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE caisse');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE dd');
        $this->addSql('DROP TABLE detail_vc');
        $this->addSql('DROP TABLE dette');
        $this->addSql('DROP TABLE dette_par_vente');
        $this->addSql('DROP TABLE due');
        $this->addSql('DROP TABLE frais');
        $this->addSql('DROP TABLE payement');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE superviseur');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vc');
        $this->addSql('DROP TABLE vendeur');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
