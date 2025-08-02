<?php

declare(strict_types=1);

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Infrastructure\Doctrine\Entity\Product;
use Infrastructure\Doctrine\Entity\Supplier;

final class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private const array PRODUCTS = [
        [
            'uuid' => 'uuid-product-1',
            'nature' => 'Assurance vie',
            'name' => 'Product 1',
            'picture' => '/images/product-1/product-1.png',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'supplierCode' => 'supplier.code1',
            'supplier' => 'uuid-supplier-1',
            'crmId' => 1,
        ],
        [
            'uuid' => 'uuid-product-2',
            'nature' => 'SCPI',
            'name' => 'SCPI PRODUCT 2',
            'picture' => '/images/product-2/product-2.png',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'warning' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'supplierCode' => 'supplier.code2',
            'supplier' => 'uuid-supplier-2',
            'crmId' => 2,
        ],
        [
            'uuid' => 'uuid-product-3',
            'nature' => 'SCPI',
            'name' => 'SCPI PRODUCT 3',
            'picture' => '',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'warning' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'supplierCode' => '',
            'supplier' => 'uuid-supplier-3',
            'crmId' => 3,
        ],
        [
            'uuid' => 'uuid-product-4',
            'nature' => 'Assurance vie',
            'name' => 'Produit 4',
            'picture' => '/images/product-4/product-4.png',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'warning' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'supplierCode' => 'supplier.code3',
            'supplier' => 'uuid-supplier-4',
            'crmId' => 4,
        ],
        [
            'uuid' => 'uuid-product-5',
            'nature' => 'Assurance vie',
            'name' => 'Vivalor',
            'picture' => '/images/product-5/product-5.png',
            'description' => null,
            'warning' => null,
            'supplierCode' => 'supplier.code4',
            'supplier' => 'uuid-supplier-1',
            'archivedAt' => '2024-12-04',
            'crmId' => 5,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $product) {
            $entity = new Product();
            $entity->uuid = $product['uuid'];
            $entity->nature = $product['nature'];
            $entity->name = $product['name'];
            $entity->picture = $product['picture'];
            $entity->description = $product['description'];
            $entity->warning = $product['warning'] ?? null;
            $entity->supplierCode = $product['supplierCode'];
            $entity->supplier = $this->getReference(Supplier::class.'-'.$product['supplier'], Supplier::class);
            $entity->archivedAt = isset($product['archivedAt']) ? new \DateTime($product['archivedAt']) : null;
            $entity->crmId = $product['crmId'];
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SupplierFixtures::class,
        ];
    }
}
