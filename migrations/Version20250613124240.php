<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250613124240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cierre_caja (id INT AUTO_INCREMENT NOT NULL, fecha DATE NOT NULL, observaciones VARCHAR(255) DEFAULT NULL, balance DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, dni INT NOT NULL, telefono VARCHAR(255) NOT NULL, direccion VARCHAR(255) DEFAULT NULL, INDEX IDX_D9D9BF529F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_empleado (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago (id INT AUTO_INCREMENT NOT NULL, proveedor_id INT DEFAULT NULL, fecha DATE NOT NULL, monto DOUBLE PRECISION NOT NULL, cerrado TINYINT(1) NOT NULL, INDEX IDX_F4DF5F3ECB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, precio INT NOT NULL, stock INT NOT NULL, imagen VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, telefono VARCHAR(255) DEFAULT NULL, direccion VARCHAR(255) DEFAULT NULL, cuit VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registro_venta (id INT AUTO_INCREMENT NOT NULL, fecha DATETIME NOT NULL, monto_total DOUBLE PRECISION NOT NULL, productos JSON NOT NULL, cerrada TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF529F5A440B FOREIGN KEY (estado_id) REFERENCES estado_empleado (id)');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3ECB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF529F5A440B');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3ECB305D73');
        $this->addSql('DROP TABLE cierre_caja');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE estado_empleado');
        $this->addSql('DROP TABLE pago');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP TABLE registro_venta');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
