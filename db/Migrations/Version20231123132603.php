<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123132603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(125) NOT NULL, surname VARCHAR(125) NOT NULL, email VARCHAR(125) NOT NULL, phone VARCHAR(25) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, product_id INT DEFAULT NULL, price INT NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_E52FFDEE9395C3F3 (customer_id), INDEX IDX_E52FFDEE4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, ean VARCHAR(255) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE4584665A');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE product');
    }
}
