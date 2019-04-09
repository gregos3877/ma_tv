<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308095345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE diffusion (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenu_diffuse (id INT AUTO_INCREMENT NOT NULL, tv_id INT NOT NULL, chaine_id INT NOT NULL, INDEX IDX_66D21B811D245270 (tv_id), INDEX IDX_66D21B813129D93D (chaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenu_diffuse ADD CONSTRAINT FK_66D21B811D245270 FOREIGN KEY (tv_id) REFERENCES tv (id)');
        $this->addSql('ALTER TABLE contenu_diffuse ADD CONSTRAINT FK_66D21B813129D93D FOREIGN KEY (chaine_id) REFERENCES chaine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE diffusion');
        $this->addSql('DROP TABLE contenu_diffuse');
    }
}
