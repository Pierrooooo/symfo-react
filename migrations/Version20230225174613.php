<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230225174613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flash (id INT AUTO_INCREMENT NOT NULL, tatoueur_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, size INT DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AFCE5F0330B0A5F2 (tatoueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, salon_id INT DEFAULT NULL, flash_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10C1EC9CE27 (salon_id), INDEX IDX_6A2CA10C25F8D5EA (flash_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tatoueurs (id INT AUTO_INCREMENT NOT NULL, salon_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, instagram VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', all_colors TINYINT(1) DEFAULT NULL, INDEX IDX_D7796221EC9CE27 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tatoueurs_color (tatoueurs_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_67CD98EB4F29EB0 (tatoueurs_id), INDEX IDX_67CD98E7ADA1FB5 (color_id), PRIMARY KEY(tatoueurs_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flash ADD CONSTRAINT FK_AFCE5F0330B0A5F2 FOREIGN KEY (tatoueur_id) REFERENCES tatoueurs (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C1EC9CE27 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C25F8D5EA FOREIGN KEY (flash_id) REFERENCES flash (id)');
        $this->addSql('ALTER TABLE tatoueurs ADD CONSTRAINT FK_D7796221EC9CE27 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE tatoueurs_color ADD CONSTRAINT FK_67CD98EB4F29EB0 FOREIGN KEY (tatoueurs_id) REFERENCES tatoueurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tatoueurs_color ADD CONSTRAINT FK_67CD98E7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flash DROP FOREIGN KEY FK_AFCE5F0330B0A5F2');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C1EC9CE27');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C25F8D5EA');
        $this->addSql('ALTER TABLE tatoueurs DROP FOREIGN KEY FK_D7796221EC9CE27');
        $this->addSql('ALTER TABLE tatoueurs_color DROP FOREIGN KEY FK_67CD98EB4F29EB0');
        $this->addSql('ALTER TABLE tatoueurs_color DROP FOREIGN KEY FK_67CD98E7ADA1FB5');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE flash');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP TABLE tatoueurs');
        $this->addSql('DROP TABLE tatoueurs_color');
    }
}
