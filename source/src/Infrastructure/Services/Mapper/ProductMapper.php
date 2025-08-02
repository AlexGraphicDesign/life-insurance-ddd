<?php

declare(strict_types=1);

namespace Infrastructure\Services\Mapper;

use Domain\Product\Model\Product as ProductModel;
use Infrastructure\Doctrine\Entity\Product as ProductEntity;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;

/**
 * @implements EntityMapperInterface<ProductModel>
 */
final readonly class ProductMapper implements EntityMapperInterface
{
    public function support(BaseEntity $entity): bool
    {
        return $entity instanceof ProductEntity;
    }

    /**
     * @param ProductEntity $entity
     */
    public function toDomain(BaseEntity $entity): ProductModel
    {
        return new ProductModel(
            uuid: $entity->uuid,
            nature: $entity->nature,
            name: $entity->name,
            supplier: $entity->supplier->uuid,
            picture: $entity->picture,
            description: $entity->description,
            warning: $entity->warning,
            supplierCode: $entity->supplierCode,
            archivedAt: $entity->archivedAt,
            crmId: $entity->crmId,
        );
    }
}
