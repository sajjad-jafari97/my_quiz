<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926130942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reponse');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, question VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_question INT DEFAULT NULL, reponse VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, reponse_expected TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
