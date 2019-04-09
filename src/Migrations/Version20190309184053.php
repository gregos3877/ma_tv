<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190309184053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chaine ADD plateform_id INT NOT NULL');
        $this->addSql('ALTER TABLE chaine ADD CONSTRAINT FK_94DA53ECCCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id)');
        $this->addSql('CREATE INDEX IDX_94DA53ECCCAA542F ON chaine (plateform_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chaine DROP FOREIGN KEY FK_94DA53ECCCAA542F');
        $this->addSql('DROP INDEX IDX_94DA53ECCCAA542F ON chaine');
        $this->addSql('ALTER TABLE chaine DROP plateform_id');
    }
}
