<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117103727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, booking_date DATETIME NOT NULL, start_date DATETIME NOT NULL, time_range VARCHAR(25) NOT NULL, INDEX IDX_E00CEDDE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_equipment (booking_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_400A1E803301C60 (booking_id), INDEX IDX_400A1E80517FE9FE (equipment_id), PRIMARY KEY(booking_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_user (booking_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9502F4073301C60 (booking_id), INDEX IDX_9502F407A76ED395 (user_id), PRIMARY KEY(booking_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE booking_equipment ADD CONSTRAINT FK_400A1E803301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_equipment ADD CONSTRAINT FK_400A1E80517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_user ADD CONSTRAINT FK_9502F4073301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_user ADD CONSTRAINT FK_9502F407A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking_user DROP FOREIGN KEY FK_9502F407A76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('ALTER TABLE booking_equipment DROP FOREIGN KEY FK_400A1E80517FE9FE');
        $this->addSql('ALTER TABLE booking_equipment DROP FOREIGN KEY FK_400A1E803301C60');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_equipment');
        $this->addSql('DROP TABLE booking_user');
    }
}
