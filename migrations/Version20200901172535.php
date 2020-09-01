<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901172535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, volume INT NOT NULL, origin VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_7B4914D412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_cocktail (ingredient_id INT NOT NULL, cocktail_id INT NOT NULL, INDEX IDX_94F445A933FE08C (ingredient_id), INDEX IDX_94F445ACD6F76C6 (cocktail_id), PRIMARY KEY(ingredient_id, cocktail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ingredient_cocktail ADD CONSTRAINT FK_94F445A933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_cocktail ADD CONSTRAINT FK_94F445ACD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D412469DE2');
        $this->addSql('ALTER TABLE ingredient_cocktail DROP FOREIGN KEY FK_94F445ACD6F76C6');
        $this->addSql('ALTER TABLE ingredient_cocktail DROP FOREIGN KEY FK_94F445A933FE08C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE cocktail');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_cocktail');
    }
}
