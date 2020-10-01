<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201001085205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sorties_participants (sorties_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_BB662DEC15DFCFB2 (sorties_id), INDEX IDX_BB662DEC838709D5 (participants_id), PRIMARY KEY(sorties_id, participants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sorties_participants ADD CONSTRAINT FK_BB662DEC15DFCFB2 FOREIGN KEY (sorties_id) REFERENCES sorties (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sorties_participants ADD CONSTRAINT FK_BB662DEC838709D5 FOREIGN KEY (participants_id) REFERENCES participants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sorties DROP FOREIGN KEY FK_488163E89D1C3019');
        $this->addSql('DROP INDEX IDX_488163E89D1C3019 ON sorties');
        $this->addSql('ALTER TABLE sorties DROP organisateur, CHANGE participant_id organisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sorties ADD CONSTRAINT FK_488163E8D936B2FA FOREIGN KEY (organisateur_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_488163E8D936B2FA ON sorties (organisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sorties_participants');
        $this->addSql('ALTER TABLE sorties DROP FOREIGN KEY FK_488163E8D936B2FA');
        $this->addSql('DROP INDEX IDX_488163E8D936B2FA ON sorties');
        $this->addSql('ALTER TABLE sorties ADD organisateur INT NOT NULL, CHANGE organisateur_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sorties ADD CONSTRAINT FK_488163E89D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('CREATE INDEX IDX_488163E89D1C3019 ON sorties (participant_id)');
    }
}
