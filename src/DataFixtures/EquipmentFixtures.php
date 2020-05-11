<?php
namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EquipmentFixtures extends Fixture {

  public const EQUIPMENT1 = 'equipment1';
  public const EQUIPMENT2 = 'equipment2';
  public const EQUIPMENT3 = 'equipment3';

  public function load(ObjectManager $manager)
  {
    $equipment1 = new Equipment();
    $equipment1->setName('Kawasaki STX 15F');
    $equipment1->setDescription('Jet Ski deux place');
    $equipment1->setpower(15);
    $equipment1->setIsValid(true);
    $equipment1->setPrice(["80", "130", "220"]);
    $manager->persist($equipment1);

    $equipment2 = new Equipment();
    $equipment2->setName('See-Doo 4tec');
    $equipment2->setDescription('Jet ski une place');
    $equipment2->setpower(10);
    $equipment2->setIsValid(true);
    $equipment2->setPrice(["70", "120", "200"]);
    $manager->persist($equipment2);

    $equipment3 = new Equipment();
    $equipment3->setName('Yamaha Fx SHO');
    $equipment3->setDescription('Jet Ski deux place');
    $equipment3->setpower(20);
    $equipment3->setIsValid(true);
    $equipment3->setPrice(["90", "140", "240"]);
    $manager->persist($equipment3);

    $equipment4 = new Equipment();
    $equipment4->setName('Bouée');
    $equipment4->setDescription('De 1 à 3 personne');
    $equipment4->setIsValid(true);
    $equipment4->setPrice(["40", null, null]);
    $manager->persist($equipment4);
    
    $equipment5 = new Equipment();
    $equipment5->setName('Wake-board');
    $equipment5->setIsValid(true);
    $equipment5->setPrice(["40", null, null]);
    $manager->persist($equipment5);
    
    $equipment6 = new Equipment();
    $equipment6->setName('Bateau');
    $equipment6->setDescription("Jusqu'à 8 places disponibles");
    $equipment6->setpower(30);
    $equipment6->setIsValid(true);
    $equipment6->setPrice([null, "100", "180"]);
    $manager->persist($equipment6);

    $equipment7 = new Equipment();
    $equipment7->setName('Ski-Nautique');
    $equipment7->setIsValid(true);
    $equipment7->setPrice(["40", null, null]);
    $manager->persist($equipment7);

    $this->addReference(self::EQUIPMENT1, $equipment1);
    $this->addReference(self::EQUIPMENT2, $equipment2);
    $this->addReference(self::EQUIPMENT3, $equipment3); 

    $manager->flush();
  }
}