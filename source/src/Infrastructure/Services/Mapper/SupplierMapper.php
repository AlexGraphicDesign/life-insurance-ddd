<?php

declare(strict_types=1);

namespace Infrastructure\Services\Mapper;

use Domain\Supplier\Model\Supplier as SupplierModel;
use Infrastructure\Doctrine\Entity\Supplier as SupplierEntity;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;

/**
 * @implements EntityMapperInterface<SupplierModel>
 */
final readonly class SupplierMapper implements EntityMapperInterface
{
    public function support(BaseEntity $entity): bool
    {
        return $entity instanceof SupplierEntity;
    }

    /**
     * @param SupplierEntity $entity
     */
    public function toDomain(BaseEntity $entity): SupplierModel
    {
        return new SupplierModel(
            uuid: $entity->uuid,
            name: $entity->name,
            products: $this->getProducts($entity),
            slug: $entity->slug,
            rgpd: $entity->rgpd,
            rgpdLink: $entity->rgpdLink,
            displayOnAdditional: $entity->displayOnAdditional,
            displayOnArbitration: $entity->displayOnArbitration,
        );
    }

    /**
     * @return array<int, string>
     */
    private function getProducts(SupplierEntity $entity): array
    {
        return array_map(
            static fn ($product) => $product->uuid,
            $entity->products->toArray()
        );
    }
}
