<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809185654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE104C1D3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBB649746');
        $this->addSql('ALTER TABLE product ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX fk_d34a04ade104c1d3 ON product');
        $this->addSql('CREATE INDEX IDX_D34A04ADE104C1D3 ON product (created_user_id)');
        $this->addSql('DROP INDEX fk_d34a04adbb649746 ON product');
        $this->addSql('CREATE INDEX IDX_D34A04ADBB649746 ON product (updated_user_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE104C1D3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBB649746');
        $this->addSql('ALTER TABLE product DROP deleted_at');
        $this->addSql('DROP INDEX idx_d34a04adbb649746 ON product');
        $this->addSql('CREATE INDEX FK_D34A04ADBB649746 ON product (updated_user_id)');
        $this->addSql('DROP INDEX idx_d34a04ade104c1d3 ON product');
        $this->addSql('CREATE INDEX FK_D34A04ADE104C1D3 ON product (created_user_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
    }
}
