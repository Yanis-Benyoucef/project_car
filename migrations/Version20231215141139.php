<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215141139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF079F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF079F37AE5 ON avis (id_user_id)');
        $this->addSql('ALTER TABLE image ADD id_vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FF1D99706 FOREIGN KEY (id_vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FF1D99706 ON image (id_vehicle_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('CREATE INDEX IDX_D79572D912469DE2 ON model (category_id)');
        $this->addSql('ALTER TABLE reservations ADD id_vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239F1D99706 FOREIGN KEY (id_vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_4DA239F1D99706 ON reservations (id_vehicle_id)');
        $this->addSql('ALTER TABLE vehicle ADD fuel_type_id INT DEFAULT NULL, ADD model_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4866A70FE35 FOREIGN KEY (fuel_type_id) REFERENCES fuel (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_1B80E4866A70FE35 ON vehicle (fuel_type_id)');
        $this->addSql('CREATE INDEX IDX_1B80E4867975B7E7 ON vehicle (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF079F37AE5');
        $this->addSql('DROP INDEX IDX_8F91ABF079F37AE5 ON avis');
        $this->addSql('ALTER TABLE avis DROP id_user_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FF1D99706');
        $this->addSql('DROP INDEX IDX_C53D045FF1D99706 ON image');
        $this->addSql('ALTER TABLE image DROP id_vehicle_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D912469DE2');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('DROP INDEX IDX_D79572D912469DE2 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id, DROP category_id');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239F1D99706');
        $this->addSql('DROP INDEX IDX_4DA239F1D99706 ON reservations');
        $this->addSql('ALTER TABLE reservations DROP id_vehicle_id');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4866A70FE35');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('DROP INDEX IDX_1B80E4866A70FE35 ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E4867975B7E7 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP fuel_type_id, DROP model_id');
    }
}
