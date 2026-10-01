<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261001153315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enrollment (id INT AUTO_INCREMENT NOT NULL, enrolled_at DATETIME NOT NULL, student_id INT DEFAULT NULL, course_id INT DEFAULT NULL, INDEX IDX_DBDCD7E1CB944F1A (student_id), INDEX IDX_DBDCD7E1591CC992 (course_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE enrollment ADD CONSTRAINT FK_DBDCD7E1CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enrollment ADD CONSTRAINT FK_DBDCD7E1591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE enrollement DROP FOREIGN KEY `FK_1B002285591CC992`');
        $this->addSql('ALTER TABLE enrollement DROP FOREIGN KEY `FK_1B002285CB944F1A`');
        $this->addSql('DROP TABLE enrollement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enrollement (id INT AUTO_INCREMENT NOT NULL, enrolled_at DATETIME NOT NULL, student_id INT DEFAULT NULL, course_id INT DEFAULT NULL, INDEX IDX_1B002285591CC992 (course_id), INDEX IDX_1B002285CB944F1A (student_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE enrollement ADD CONSTRAINT `FK_1B002285591CC992` FOREIGN KEY (course_id) REFERENCES course (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE enrollement ADD CONSTRAINT `FK_1B002285CB944F1A` FOREIGN KEY (student_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE enrollment DROP FOREIGN KEY FK_DBDCD7E1CB944F1A');
        $this->addSql('ALTER TABLE enrollment DROP FOREIGN KEY FK_DBDCD7E1591CC992');
        $this->addSql('DROP TABLE enrollment');
    }
}
