<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180908074201 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_info (id INT AUTO_INCREMENT NOT NULL, ip VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, region_code VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, continent VARCHAR(255) DEFAULT NULL, continent_code VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, timezone VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, currency_code VARCHAR(255) DEFAULT NULL, currency_symbol VARCHAR(255) DEFAULT NULL, currency_exchange_rate VARCHAR(255) DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_info');
    }
}
