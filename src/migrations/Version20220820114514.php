<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220820114514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A6016BB649746');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A6016E104C1D3');
        $this->addSql('DROP INDEX FK_4E1A6016BB649746 ON paper');
        $this->addSql('DROP INDEX FK_4E1A6016E104C1D3 ON paper');
        $this->addSql('ALTER TABLE paper DROP created_user_id, DROP updated_user_id');
        $this->addSql('ALTER TABLE planner DROP FOREIGN KEY FK_95517761BB649746');
        $this->addSql('ALTER TABLE planner DROP FOREIGN KEY FK_95517761E104C1D3');
        $this->addSql('DROP INDEX FK_95517761BB649746 ON planner');
        $this->addSql('DROP INDEX FK_95517761E104C1D3 ON planner');
        $this->addSql('ALTER TABLE planner DROP created_user_id, DROP updated_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('ALTER TABLE paper ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A6016BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A6016E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_4E1A6016BB649746 ON paper (updated_user_id)');
        $this->addSql('CREATE INDEX FK_4E1A6016E104C1D3 ON paper (created_user_id)');
        $this->addSql('ALTER TABLE planner ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planner ADD CONSTRAINT FK_95517761BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planner ADD CONSTRAINT FK_95517761E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_95517761BB649746 ON planner (updated_user_id)');
        $this->addSql('CREATE INDEX FK_95517761E104C1D3 ON planner (created_user_id)');
    }
}
