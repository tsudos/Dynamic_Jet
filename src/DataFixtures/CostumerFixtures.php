<?php

// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CostumerFixtures extends Fixture {

    public const CUSTOMER1 = 'customer1';
    public const CUSTOMER2 = 'customer2';
    public const CUSTOMER3 = 'customer3';

    public function load(ObjectManager $manager) {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 2 personnes
        for ($i = 1; $i <=10;$i++) {
            if ( $i%2 != 0 ){
                $customer = new Customer();
                $customer->setFirstname($faker->name);
                $customer->setLastname($faker->name);
                $customer->setEmail($faker->email);
                $customer->setAdress($faker->address);
                $customer->setPhone($faker->phoneNumber);
                $customer->setBirthDate($faker->dateTimeThisCentury);
                $customer->setCoastalLicense('jdgzibz-'.$i);
                $customer->setReduction(Null);
                
                $manager->persist($customer);
            }
            else {
                $customer = new Customer();
                $customer->setFirstname($faker->name);
                $customer->setLastname($faker->name);
                $customer->setEmail($faker->email);
                $customer->setAdress($faker->address);
                $customer->setPhone($faker->phoneNumber);
                $customer->setBirthDate(NULL);
                $customer->setCoastalLicense(NULL);
                $customer->setReduction(Null); 
                $manager->persist($customer);
            }

            if($i === 1) {
                $this->addReference(self::CUSTOMER1, $customer);
            }
            if($i === 2) {
                $this->addReference(self::CUSTOMER2, $customer);
            }
            if($i === 3) {
                $this->addReference(self::CUSTOMER3, $customer);
            }
        }
        
        $manager->flush();
    }
}