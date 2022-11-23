<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product01 = new Product();
        $product01->setName('S21 Ultra 5G')
            ->setDescription('Conçu avec un appareil photo parfaitement intégré pour révolutionner la photographie, il vous permet de réaliser des vidéos en 8K.')
            ->setCategory($this->getReference(ProductCategoryFixtures::CATEGORY1_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $product02 = new Product();
        $product02 ->setName('Galaxy Z Fold3 5G')
            ->setDescription('En l’ouvrant comme un livre, vous accédez à un grand écran pliable qui vous permet de travailler et jouer comme jamais auparavant.')
            ->setCategory($this->getReference(ProductCategoryFixtures::CATEGORY1_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $product03 = new Product();
        $product03->setName('iPhone 14 Pro')
            ->setDescription('Une manière inédite et magique d’interagir avec votre iPhone. Des fonctionnalités de sécurité conçues pour sauver des vies.')
            ->setCategory($this->getReference(ProductCategoryFixtures::CATEGORY2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $product04 = new Product();
        $product04->setName('iPhone SE')
            ->setDescription('Le plus abordable des iPhone intègre la puissante puce A15 Bionic, la technologie 5G, une meilleure autonomie.')
            ->setCategory($this->getReference(ProductCategoryFixtures::CATEGORY2_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $product05 = new Product();
        $product05->setName('Ecouteurs Bluetooth Egsii Air Plus')
            ->setDescription('Ecouteurs stéréo intra-auriculaires pour iPhone Et Android.')
            ->setCategory($this->getReference(ProductCategoryFixtures::CATEGORY3_REFERENCE))
            ->setCreatedAt(new DateTimeImmutable('-1 day'))
            ->setUpdatedAt(new DateTimeImmutable());

        $manager->persist($product01);
        $manager->persist($product02);
        $manager->persist($product03);
        $manager->persist($product04);
        $manager->persist($product05);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductCategoryFixtures::class,
        ];
    }
}
