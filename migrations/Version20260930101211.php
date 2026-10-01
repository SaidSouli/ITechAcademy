<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260930101211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(5, 2) NOT NULL, durationh_hours INT NOT NULL, level VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, trainer_id INT NOT NULL, INDEX IDX_169E6FB9FB08EDF6 (trainer_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enrollement (id INT AUTO_INCREMENT NOT NULL, enrolled_at DATETIME NOT NULL, student_id INT DEFAULT NULL, course_id INT DEFAULT NULL, INDEX IDX_1B002285CB944F1A (student_id), INDEX IDX_1B002285591CC992 (course_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE trainer (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, bio LONGTEXT NOT NULL, photo_url VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('ALTER TABLE enrollement ADD CONSTRAINT FK_1B002285CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enrollement ADD CONSTRAINT FK_1B002285591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9FB08EDF6');
        $this->addSql('ALTER TABLE enrollement DROP FOREIGN KEY FK_1B002285CB944F1A');
        $this->addSql('ALTER TABLE enrollement DROP FOREIGN KEY FK_1B002285591CC992');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE enrollement');
        $this->addSql('DROP TABLE trainer');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
