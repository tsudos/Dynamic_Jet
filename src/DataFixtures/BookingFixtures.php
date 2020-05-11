<?php
namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookingFixtures extends Fixture implements DependentFixtureInterface {

  public function load(ObjectManager $manager)
  {
    $booking1 = new Booking();
    $booking1->setBookingDate(new \DateTime());
    $booking1->setStartDate(new \DateTime('2020-03-12 10:00:00'));
    $booking1->setTimeRange('1');
    $booking1->addStaff($this->getReference(AppFixtures::MONITEUR4));
    $booking1->addEquipment($this->getReference('equipment1'));
    $booking1->addEquipment($this->getReference(EquipmentFixtures::EQUIPMENT2));
    $booking1->setCustomer($this->getReference(CostumerFixtures::CUSTOMER1));
    $manager->persist($booking1);

    $booking2 = new Booking();
    $booking2->setBookingDate(new \DateTime('2019-12-25 13:45:00'));
    $booking2->setStartDate(new \DateTime('2020-01-12 10:30:00'));
    $booking2->setTimeRange('0');
    $booking2->addStaff($this->getReference(AppFixtures::MONITEUR5));
    $booking2->addEquipment($this->getReference(EquipmentFixtures::EQUIPMENT2));
    $booking2->setCustomer($this->getReference(CostumerFixtures::CUSTOMER2));
    $manager->persist($booking2);

    $booking = new Booking();
    $booking->setBookingDate(new \DateTime('2020-01-03 16:30:00'));
    $booking->setStartDate(new \DateTime('2020-03-12 10:00:00'));
    $booking->setTimeRange('2');
    $booking->addStaff($this->getReference(AppFixtures::MONITEUR6));
    $booking->addEquipment($this->getReference(EquipmentFixtures::EQUIPMENT3));
    $booking->setCustomer($this->getReference(CostumerFixtures::CUSTOMER3));
    $manager->persist($booking);

    $manager->flush();
  }

  public function getDependencies()
    {
      return [
        AppFixtures::class,
        EquipmentFixtures::class,
        CostumerFixtures::class,
      ];
    }
}