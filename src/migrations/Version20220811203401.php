<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220811203401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planner ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, CHANGE image_file image_file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE planner ADD CONSTRAINT FK_95517761E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planner ADD CONSTRAINT FK_95517761BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_95517761E104C1D3 ON planner (created_user_id)');
        $this->addSql('CREATE INDEX IDX_95517761BB649746 ON planner (updated_user_id)');
        $this->addSql('ALTER TABLE product ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADE104C1D3 ON product (created_user_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADBB649746 ON product (updated_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planner DROP FOREIGN KEY FK_95517761E104C1D3');
        $this->addSql('ALTER TABLE planner DROP FOREIGN KEY FK_95517761BB649746');
        $this->addSql('DROP INDEX IDX_95517761E104C1D3 ON planner');
        $this->addSql('DROP INDEX IDX_95517761BB649746 ON planner');
        $this->addSql('ALTER TABLE planner DROP created_user_id, DROP updated_user_id, CHANGE image_file image_file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE104C1D3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBB649746');
        $this->addSql('DROP INDEX IDX_D34A04ADE104C1D3 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADBB649746 ON product');
        $this->addSql('ALTER TABLE product DROP created_user_id, DROP updated_user_id');
    }
}
