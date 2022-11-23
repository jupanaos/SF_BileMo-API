<?php

namespace App\DataFixtures;

use App\Entity\CustomerAddress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerAddressFixtures extends Fixture
{
    public const ADDRESS1_REFERENCE = 'ADDRESS_1';
    public const ADDRESS2_REFERENCE = 'ADDRESS_2';
    public const ADDRESS3_REFERENCE = 'ADDRESS_3';
    public const ADDRESS4_REFERENCE = 'ADDRESS_4';
    public const ADDRESS5_REFERENCE = 'ADDRESS_5';

    public function load(ObjectManager $manager): void
    {
        $address01 = new CustomerAddress();
        $address01->setStreetNumber(59);
        $address01->setStreetName('Avenue Ferdinand de Lesseps');
        $address01->setZipcode(38100);
        $address01->setCity('GRENOBLE');

        $address02 = new CustomerAddress();
        $address02->setStreetNumber(8);
        $address02->setStreetName('Rue des lieutenants Thomazo');
        $address02->setZipcode(04000);
        $address02->setCity('DIGNE-LES-BAINS');

        $address03 = new CustomerAddress();
        $address03->setStreetNumber(65);
        $address03->setStreetName('Rue du Limas');
        $address03->setZipcode(97100);
        $address03->setCity('BASSE-TERRE');

        $address04 = new CustomerAddress();
        $address04->setStreetNumber(18);
        $address04->setStreetName('Rue Joseph Vernet');
        $address04->setZipcode(84000);
        $address04->setCity('AVIGNON');

        $address05 = new CustomerAddress();
        $address05->setStreetNumber(88);
        $address05->setStreetName('Rue de l\'Epeule');
        $address05->setZipcode(76100);
        $address05->setCity('ROUEN');

        $manager->persist($address01);
        $manager->persist($address02);
        $manager->persist($address03);
        $manager->persist($address04);
        $manager->persist($address05);

        $manager->flush();

        $this->addReference(self::ADDRESS1_REFERENCE, $address01);
        $this->addReference(self::ADDRESS2_REFERENCE, $address02);
        $this->addReference(self::ADDRESS3_REFERENCE, $address03);
        $this->addReference(self::ADDRESS4_REFERENCE, $address04);
        $this->addReference(self::ADDRESS5_REFERENCE, $address05);
    }
}
