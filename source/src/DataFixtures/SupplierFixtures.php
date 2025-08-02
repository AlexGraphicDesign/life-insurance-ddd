<?php

declare(strict_types=1);

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Infrastructure\Doctrine\Entity\Supplier;

final class SupplierFixtures extends Fixture
{
    private const array SUPPLIERS = [
        [
            'uuid' => 'uuid-supplier-1',
            'name' => 'Supplier 1',
            'slug' => 'supplier-1',
            'rgpd' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
            'rgpdLink' => '/download/supplier-1/rgpd.pdf',
            'displayOnAdditional' => true,
            'displayOnArbitration' => true,
        ],
        [
            'uuid' => 'uuid-supplier-5',
            'name' => 'Supplier 5',
            'slug' => 'supplier-5',
        ],
        [
            'uuid' => 'uuid-supplier-2',
            'name' => 'Supplier 2',
            'slug' => 'supplier-2',
        ],
        [
            'uuid' => 'uuid-supplier-6',
            'name' => 'Supplier 6',
            'slug' => 'supplier-6',
        ],
        [
            'uuid' => 'uuid-supplier-3',
            'name' => 'Supplier 3',
            'slug' => 'supplier-3',
        ],
        [
            'uuid' => 'uuid-supplier-7',
            'name' => 'Supplier 7',
            'slug' => 'supplier-7',
        ],
        [
            'uuid' => 'uuid-supplier-8',
            'name' => 'Supplier 8',
            'slug' => 'supplier-8',
        ],
        [
            'uuid' => 'uuid-supplier-4',
            'name' => 'Supplier 4',
            'slug' => 'supplier-4',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SUPPLIERS as $supplier) {
            $entity = new Supplier();
            $entity->uuid = $supplier['uuid'];
            $entity->name = $supplier['name'];
            $entity->slug = $supplier['slug'];
            $entity->rgpd = $supplier['rgpd'] ?? null;
            $entity->rgpdLink = $supplier['rgpdLink'] ?? null;
            $entity->displayOnAdditional = $supplier['displayOnAdditional'] ?? false;
            $entity->displayOnArbitration = $supplier['displayOnArbitration'] ?? false;
            $this->setReference(Supplier::class.'-'.$supplier['uuid'], $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
