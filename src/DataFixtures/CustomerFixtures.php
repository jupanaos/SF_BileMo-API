<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /* Registered users for customers (user01) */
        $customer01 = new Customer();
        $customer01->setFirstName('Nicolas')
            ->setLastName('Charette')
            ->setEmail('nicolas.charette@bilemo.fr')
            ->setAddress($this->getReference(CustomerAddressFixtures::ADDRESS1_REFERENCE))
            ->setPhone('0529548847')
            ->setUser($this->getReference(UserFixtures::USER1_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        /* Registered users for customers (user02) */
        $customer02 = new Customer();
        $customer02->setFirstName('Claude')
            ->setLastName('Gervais')
            ->setEmail('claude.gervais@rhyta.com')
            ->setAddress($this->getReference(CustomerAddressFixtures::ADDRESS2_REFERENCE))
            ->setPhone('0412279096')
            ->setUser($this->getReference(UserFixtures::USER2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $customer03 = new Customer();
        $customer03->setFirstName('Marine')
            ->setLastName('Godin')
            ->setEmail('marine.godin@armyspy.com')
            ->setAddress($this->getReference(CustomerAddressFixtures::ADDRESS3_REFERENCE))
            ->setPhone('0555348276')
            ->setUser($this->getReference(UserFixtures::USER2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $customer04 = new Customer();
        $customer04->setFirstName('Victoire')
            ->setLastName('Beaupré')
            ->setEmail('victoire.beaupre@dayrep.com')
            ->setAddress($this->getReference(CustomerAddressFixtures::ADDRESS4_REFERENCE))
            ->setPhone('0362805237')
            ->setUser($this->getReference(UserFixtures::USER2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $customer05 = new Customer();
        $customer05->setFirstName('Olivier')
            ->setLastName('Arpin')
            ->setEmail('olivier.arpin@jourrapide.com')
            ->setAddress($this->getReference(CustomerAddressFixtures::ADDRESS5_REFERENCE))
            ->setPhone('0244460778')
            ->setUser($this->getReference(UserFixtures::USER2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());


        $manager->persist($customer01);
        $manager->persist($customer02);
        $manager->persist($customer03);
        $manager->persist($customer04);
        $manager->persist($customer05);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CustomerAddressFixtures::class,
        ];
    }
}
