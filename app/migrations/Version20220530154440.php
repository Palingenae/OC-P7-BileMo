<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530154440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, reseller_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, postal_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_81398E0991E6A19D (reseller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, postal_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, vat_number VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, reseller_id INT NOT NULL, model_name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, operating_system VARCHAR(255) NOT NULL, cpu VARCHAR(255) NOT NULL, storage VARCHAR(255) NOT NULL, screen_size VARCHAR(255) NOT NULL, screen_type VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, price NUMERIC(6, 2) NOT NULL, INDEX IDX_D34A04AD91E6A19D (reseller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0991E6A19D FOREIGN KEY (reseller_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD91E6A19D FOREIGN KEY (reseller_id) REFERENCES partner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0991E6A19D');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD91E6A19D');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE product');
    }
}
