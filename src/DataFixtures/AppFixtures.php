<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public const MONITEUR4 = 'moniteur4';
    public const MONITEUR5 = 'moniteur5';
    public const MONITEUR6 = 'moniteur6';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        

        //USER 1
        $email = "Christine.toval@jetski.com";
        $firstname = "Christine";
        $lastname = "Toval";
        $password = "password";
        $ss_number = "1 77 04 25 312 114 26";
        $hiring_date = null;
        $me_date = new \DateTime("10/04/2021");
        $status = "Secretaire";
        $coastal_licence = null;
        $bees = false;
        $contract_type = "CDI";

        $user1 = new User();

        $user1->setEmail($email);
        $user1->setFirstName($firstname);
        $user1->setLastName($lastname);
        $user1->setPassword($this->encoder->encodePassword($user1, $password));
        $user1->setSsNumber($ss_number); 
        $user1->setHiringDate($hiring_date);
        $user1->setMeDate($me_date);
        $user1->setStatus($status);
        $user1->setCoastalLicence($coastal_licence);
        $user1->setBees($bees);     
        $user1->setContractType($contract_type);  

        $manager->persist($user1);

        //USER 2
        $email = "Damien.fayolle@jetski.com";
        $firstname = "Damien";
        $lastname = "Fayolle";
        $password = "password";
        $ss_number = "1 77 04 25 275 115 26";
        $hiring_date = null;
        $me_date = new \DateTime ("03/07/2020");
        $status = "Plagiste";
        $coastal_licence = "4528";
        $bees = false;
        $contract_type = "CDD";

        $user2 = new User();

        $user2->setEmail($email);
        $user2->setFirstName($firstname);
        $user2->setLastName($lastname);
        $user2->setPassword($this->encoder->encodePassword($user2, $password));
        $user2->setSsNumber($ss_number); 
        $user2->setHiringDate($hiring_date);
        $user2->setMeDate($me_date);
        $user2->setStatus($status);
        $user2->setCoastalLicence($coastal_licence);
        $user2->setBees($bees);     
        $user2->setContractType($contract_type);  

        $manager->persist($user2);

        //USER 3
        $email = "Stephanie.chorel@jetski.com";
        $firstname = "Cynthia";
        $lastname = "Chorel";
        $password = "password";
        $ss_number = "1 75 04 34 273 115 26";
        $hiring_date = null;
        $me_date = new \DateTime ("03/07/2020");
        $status = "Plagiste";
        $coastal_licence = null;
        $bees = false;
        $contract_type = "CDD";

        $user3 = new User();

        $user3->setEmail($email);
        $user3->setFirstName($firstname);
        $user3->setLastName($lastname);
        $user3->setPassword($this->encoder->encodePassword($user3, $password));
        $user3->setSsNumber($ss_number); 
        $user3->setHiringDate($hiring_date);
        $user3->setMeDate($me_date);
        $user3->setStatus($status);
        $user3->setCoastalLicence($coastal_licence);
        $user3->setBees($bees);     
        $user3->setContractType($contract_type);  

        $manager->persist($user3);

        //USER 4
        $email = "Arthur.Lhermet@jetski.com";
        $firstname = "Arthur";
        $lastname = "Lhermet";
        $password = "password";
        $ss_number = "1 77 04 25 275 116 76";
        $hiring_date = null;
        $me_date = new \DateTime ("03/09/2020");
        $status = "Moniteur";
        $coastal_licence = "4542";
        $bees = true;
        $contract_type = "CDD";

        $user4 = new User();

        $user4->setEmail($email);
        $user4->setFirstName($firstname);
        $user4->setLastName($lastname);
        $user4->setPassword($this->encoder->encodePassword($user4, $password));
        $user4->setSsNumber($ss_number); 
        $user4->setHiringDate($hiring_date);
        $user4->setMeDate($me_date);
        $user4->setStatus($status);
        $user4->setCoastalLicence($coastal_licence);
        $user4->setBees($bees);     
        $user4->setContractType($contract_type);  

        $manager->persist($user4);

        //USER 5
        $email = "Arthur.Lhermet@jetski.com";
        $firstname = "Arthur";
        $lastname = "Lhermet";
        $password = "password";
        $ss_number = "1 77 04 25 275 116 76";
        $hiring_date = null;
        $me_date = new \DateTime ("03/09/2020");
        $status = "Moniteur";
        $coastal_licence = "4547";
        $bees = true;
        $contract_type = "CDD";

        $user5 = new User();

        $user5->setEmail($email);
        $user5->setFirstName($firstname);
        $user5->setLastName($lastname);
        $user5->setPassword($this->encoder->encodePassword($user5, $password));
        $user5->setSsNumber($ss_number); 
        $user5->setHiringDate($hiring_date);
        $user5->setMeDate($me_date);
        $user5->setStatus($status);
        $user5->setCoastalLicence($coastal_licence);
        $user5->setBees($bees);     
        $user5->setContractType($contract_type);  

        $manager->persist($user5);

        //USER 6
        $email = "Alexis.berger@jetski.com";
        $firstname = "Alexis";
        $lastname = "berger";
        $password = "password";
        $ss_number = "1 77 05 25 277 115 76";
        $hiring_date = null;
        $me_date = new \DateTime ("03/09/2020");
        $status = "Moniteur";
        $coastal_licence = "4555";
        $bees = true;
        $contract_type = "CDI";

        $user6 = new User();

        $user6->setEmail($email);
        $user6->setFirstName($firstname);
        $user6->setLastName($lastname);
        $user6->setPassword($this->encoder->encodePassword($user6, $password));
        $user6->setSsNumber($ss_number); 
        $user6->setHiringDate($hiring_date);
        $user6->setMeDate($me_date);
        $user6->setStatus($status);
        $user6->setCoastalLicence($coastal_licence);
        $user6->setBees($bees);     
        $user6->setContractType($contract_type);  

        $manager->persist($user6);

        $this->addReference(self::MONITEUR4, $user4);
        $this->addReference(self::MONITEUR5, $user5);
        $this->addReference(self::MONITEUR6, $user6);

        $manager->flush();
    }
}
