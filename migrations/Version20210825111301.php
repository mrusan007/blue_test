<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825111301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A688A25CA2 FOREIGN KEY (meals_id) REFERENCES meals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A68D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB88A25CA2 FOREIGN KEY (meals_id) REFERENCES meals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA12469DE2');
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB88A25CA2');
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB3EC4DCE');
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A688A25CA2');
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A68D7B4FB4');
    }
}
