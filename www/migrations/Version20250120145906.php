<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120145906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bike (id INT AUTO_INCREMENT NOT NULL, model_id_id INT DEFAULT NULL, brand_id_id INT DEFAULT NULL, cylenders_id_id INT DEFAULT NULL, release_date DATETIME NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, INDEX IDX_4CBC37804107BEA0 (model_id_id), INDEX IDX_4CBC378024BD5740 (brand_id_id), INDEX IDX_4CBC37805F004A29 (cylenders_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bike_places (bike_id INT NOT NULL, places_id INT NOT NULL, INDEX IDX_920054A1D5A4816F (bike_id), INDEX IDX_920054A18317B347 (places_id), PRIMARY KEY(bike_id, places_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cylenders (id INT AUTO_INCREMENT NOT NULL, cc INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, bike_id INT DEFAULT NULL, image_path VARCHAR(255) NOT NULL, INDEX IDX_C53D045FD5A4816F (bike_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, model_name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, nbr INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bike ADD CONSTRAINT FK_4CBC37804107BEA0 FOREIGN KEY (model_id_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE bike ADD CONSTRAINT FK_4CBC378024BD5740 FOREIGN KEY (brand_id_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE bike ADD CONSTRAINT FK_4CBC37805F004A29 FOREIGN KEY (cylenders_id_id) REFERENCES cylenders (id)');
        $this->addSql('ALTER TABLE bike_places ADD CONSTRAINT FK_920054A1D5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bike_places ADD CONSTRAINT FK_920054A18317B347 FOREIGN KEY (places_id) REFERENCES places (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bike DROP FOREIGN KEY FK_4CBC37804107BEA0');
        $this->addSql('ALTER TABLE bike DROP FOREIGN KEY FK_4CBC378024BD5740');
        $this->addSql('ALTER TABLE bike DROP FOREIGN KEY FK_4CBC37805F004A29');
        $this->addSql('ALTER TABLE bike_places DROP FOREIGN KEY FK_920054A1D5A4816F');
        $this->addSql('ALTER TABLE bike_places DROP FOREIGN KEY FK_920054A18317B347');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD5A4816F');
        $this->addSql('DROP TABLE bike');
        $this->addSql('DROP TABLE bike_places');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE cylenders');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
