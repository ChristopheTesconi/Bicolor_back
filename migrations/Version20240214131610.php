<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214131610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scores (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, games_id INT DEFAULT NULL, nb_points INT DEFAULT NULL, start_game DATETIME DEFAULT NULL, end_game DATETIME DEFAULT NULL, INDEX IDX_750375EA76ED395 (user_id), INDEX IDX_750375E97FFC673 (games_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375E97FFC673 FOREIGN KEY (games_id) REFERENCES games (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375EA76ED395');
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375E97FFC673');
        $this->addSql('DROP TABLE scores');
    }
}
