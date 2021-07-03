<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210703013150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation ADD cat_eva_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5755BF44314 FOREIGN KEY (cat_eva_id) REFERENCES categorie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1323A5755BF44314 ON evaluation (cat_eva_id)');
        $this->addSql('ALTER TABLE resultat ADD evaluation_id INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE2456C5646 ON resultat (evaluation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5755BF44314');
        $this->addSql('DROP INDEX UNIQ_1323A5755BF44314 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP cat_eva_id');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE2456C5646');
        $this->addSql('DROP INDEX IDX_E7DB5DE2456C5646 ON resultat');
        $this->addSql('ALTER TABLE resultat DROP evaluation_id');
    }
}
