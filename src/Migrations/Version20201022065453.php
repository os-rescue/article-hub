<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022065453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

NT \'(DC2Type:uuid)\', created_by CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_294414F6DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');        $this->addSql('CREATE TABLE ah_article (id CHAR(36) NOT NULL COMME
        $this->addSql('CREATE TABLE ah_article_comment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', article_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_by CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_12B1130E7294869C (article_id), INDEX IDX_12B1130EDE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ah_article ADD CONSTRAINT FK_294414F6DE12AB56 FOREIGN KEY (created_by) REFERENCES ah_user (id)');
        $this->addSql('ALTER TABLE ah_article_comment ADD CONSTRAINT FK_12B1130E7294869C FOREIGN KEY (article_id) REFERENCES ah_article (id)');
        $this->addSql('ALTER TABLE ah_article_comment ADD CONSTRAINT FK_12B1130EDE12AB56 FOREIGN KEY (created_by) REFERENCES ah_user (id)');
        $this->addSql('ALTER TABLE ah_user DROP address, DROP phone_number, DROP mobile_number');
        $this->addSql('ALTER TABLE ah_user RENAME INDEX uniq_89fd485bc05fb297 TO UNIQ_429E4457C05FB297');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ah_article_comment DROP FOREIGN KEY FK_12B1130E7294869C');
        $this->addSql('DROP TABLE ah_article');
        $this->addSql('DROP TABLE ah_article_comment');
        $this->addSql('ALTER TABLE ah_user ADD address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD phone_number VARCHAR(35) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mobile_number VARCHAR(35) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ah_user RENAME INDEX uniq_429e4457c05fb297 TO UNIQ_89FD485BC05FB297');
    }
}
