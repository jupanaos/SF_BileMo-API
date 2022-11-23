<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    public const USER1_REFERENCE = 'USER_1';
    public const USER2_REFERENCE = 'USER_2';
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) 
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        /* Super admin (= BileMo: can read/edit/delete all datas) */
        $user01 = new User();
        $user01->setEmail('admin@bilemo.fr')
            ->setRoles([User::ROLE_BILEMO])
            ->setUsername('bilemo')
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());
        $password = $this->hasher->hashPassword($user01, "bilemo");
        $user01->setPassword($password);

        /* Customer (= a BileMo's customer who can read/edit/delete their own customers) */
        $user02 = new User();
        $user02->setEmail('customer@bilemo-cie.fr')
            ->setRoles([User::ROLE_CUSTOMER])
            ->setUsername('customer')
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());
        $password = $this->hasher->hashPassword($user02, "customer");
        $user02->setPassword($password);

        $manager->persist($user01);
        $manager->persist($user02);

        $manager->flush();

        $this->addReference(self::USER1_REFERENCE, $user01);
        $this->addReference(self::USER2_REFERENCE, $user02);
    }
}
