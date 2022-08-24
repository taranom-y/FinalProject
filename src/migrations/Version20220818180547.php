<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818180547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paper (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, type VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, image_file VARCHAR(255) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX IDX_95517761BB649746 ON planner');
        $this->addSql('DROP INDEX IDX_95517761E104C1D3 ON planner');
        $this->addSql('ALTER TABLE planner ADD type VARCHAR(255) NOT NULL, DROP created_user_id, DROP updated_user_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBB649746');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE104C1D3');
        $this->addSql('ALTER TABLE product DROP owner');
        $this->addSql('DROP INDEX fk_d34a04ade104c1d3 ON product');
        $this->addSql('CREATE INDEX IDX_D34A04ADE104C1D3 ON product (created_user_id)');
        $this->addSql('DROP INDEX fk_d34a04adbb649746 ON product');
        $this->addSql('CREATE INDEX IDX_D34A04ADBB649746 ON product (updated_user_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE paper');
        $this->addSql('ALTER TABLE planner ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, DROP type');
        $this->addSql('CREATE INDEX IDX_95517761BB649746 ON planner (updated_user_id)');
        $this->addSql('CREATE INDEX IDX_95517761E104C1D3 ON planner (created_user_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE104C1D3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBB649746');
        $this->addSql('ALTER TABLE product ADD owner VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_d34a04adbb649746 ON product');
        $this->addSql('CREATE INDEX FK_D34A04ADBB649746 ON product (updated_user_id)');
        $this->addSql('DROP INDEX idx_d34a04ade104c1d3 ON product');
        $this->addSql('CREATE INDEX FK_D34A04ADE104C1D3 ON product (created_user_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
    }
}
