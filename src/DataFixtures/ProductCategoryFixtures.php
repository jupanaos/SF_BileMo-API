<?php

namespace App\DataFixtures;

use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductCategoryFixtures extends Fixture
{
    public const CATEGORY1_REFERENCE = 'category-1';
    public const CATEGORY2_REFERENCE = 'category-2';
    public const CATEGORY3_REFERENCE = 'category-3';
    
    public function load(ObjectManager $manager): void
    {
        $category01 = new ProductCategory();
        $category01->setName('Smartphone Android');

        $category02 = new ProductCategory();
        $category02->setName('iPhone');

        $category03 = new ProductCategory();
        $category03->setName('Accessoires');
        
        $manager->persist($category01);
        $manager->persist($category02);
        $manager->persist($category03);

        $manager->flush();

        $this->addReference(self::CATEGORY1_REFERENCE, $category01);
        $this->addReference(self::CATEGORY2_REFERENCE, $category02);
        $this->addReference(self::CATEGORY3_REFERENCE, $category03);
    }
}
