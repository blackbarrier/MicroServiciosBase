<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925131315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, legajo INT NOT NULL, INDEX IDX_D9D9BF529F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF529F5A440B FOREIGN KEY (estado_id) REFERENCES estado_empleado (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF529F5A440B');
        $this->addSql('DROP TABLE empleado');
    }
}
