<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250314122537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, academic_year VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, challenge_id INT NOT NULL, admin_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, points INT NOT NULL, repeatable TINYINT(1) NOT NULL, max_repetitions INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_9067F23C98A21AC6 (challenge_id), INDEX IDX_9067F23C642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_submission (id INT AUTO_INCREMENT NOT NULL, ambassador_id INT NOT NULL, mission_id INT DEFAULT NULL, admin_id INT DEFAULT NULL, proof_path VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, rejection_reason LONGTEXT DEFAULT NULL, submission_date DATETIME NOT NULL, validation_date DATETIME DEFAULT NULL, INDEX IDX_990577684A709FDF (ambassador_id), INDEX IDX_99057768BE6CAE90 (mission_id), INDEX IDX_99057768642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranking (id INT AUTO_INCREMENT NOT NULL, ambassador_id INT DEFAULT NULL, challenge_id INT DEFAULT NULL, INDEX IDX_80B839D04A709FDF (ambassador_id), INDEX IDX_80B839D098A21AC6 (challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, shcool_name VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C98A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C642B8210 FOREIGN KEY (admin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mission_submission ADD CONSTRAINT FK_990577684A709FDF FOREIGN KEY (ambassador_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mission_submission ADD CONSTRAINT FK_99057768BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE mission_submission ADD CONSTRAINT FK_99057768642B8210 FOREIGN KEY (admin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT FK_80B839D04A709FDF FOREIGN KEY (ambassador_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT FK_80B839D098A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C98A21AC6');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C642B8210');
        $this->addSql('ALTER TABLE mission_submission DROP FOREIGN KEY FK_990577684A709FDF');
        $this->addSql('ALTER TABLE mission_submission DROP FOREIGN KEY FK_99057768BE6CAE90');
        $this->addSql('ALTER TABLE mission_submission DROP FOREIGN KEY FK_99057768642B8210');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY FK_80B839D04A709FDF');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY FK_80B839D098A21AC6');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_submission');
        $this->addSql('DROP TABLE ranking');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE user');
    }
}
