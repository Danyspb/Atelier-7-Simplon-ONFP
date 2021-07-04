<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704002447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE resultat');
        $this->addSql('ALTER TABLE evaluation ADD date_evaluation DATE NOT NULL, ADD note1 DOUBLE PRECISION DEFAULT NULL, ADD note2 DOUBLE PRECISION DEFAULT NULL, ADD note3 DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, evaluation_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_E7DB5DE2456C5646 (evaluation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE evaluation DROP date_evaluation, DROP note1, DROP note2, DROP note3');
    }
}
