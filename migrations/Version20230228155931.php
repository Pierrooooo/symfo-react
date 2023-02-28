<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228155931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C1EC9CE27');
        $this->addSql('DROP INDEX IDX_6A2CA10C1EC9CE27 ON media');
        $this->addSql('ALTER TABLE media CHANGE salon_id_id salon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4C91BDE4 ON media (salon_id)');
        $this->addSql('ALTER TABLE tatoueurs DROP FOREIGN KEY FK_D7796221EC9CE27');
        $this->addSql('DROP INDEX IDX_D7796221EC9CE27 ON tatoueurs');
        $this->addSql('ALTER TABLE tatoueurs CHANGE salon_id_id salon_id INT NOT NULL');
        $this->addSql('ALTER TABLE tatoueurs ADD CONSTRAINT FK_D7796224C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('CREATE INDEX IDX_D7796224C91BDE4 ON tatoueurs (salon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4C91BDE4');
        $this->addSql('DROP INDEX IDX_6A2CA10C4C91BDE4 ON media');
        $this->addSql('ALTER TABLE media CHANGE salon_id salon_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C1EC9CE27 FOREIGN KEY (salon_id_id) REFERENCES salon (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C1EC9CE27 ON media (salon_id_id)');
        $this->addSql('ALTER TABLE tatoueurs DROP FOREIGN KEY FK_D7796224C91BDE4');
        $this->addSql('DROP INDEX IDX_D7796224C91BDE4 ON tatoueurs');
        $this->addSql('ALTER TABLE tatoueurs CHANGE salon_id salon_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE tatoueurs ADD CONSTRAINT FK_D7796221EC9CE27 FOREIGN KEY (salon_id_id) REFERENCES salon (id)');
        $this->addSql('CREATE INDEX IDX_D7796221EC9CE27 ON tatoueurs (salon_id_id)');
    }
}
