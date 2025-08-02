<?php

declare(strict_types=1);

namespace Infrastructure\Services\Mapper;

use Domain\Common\Model\BaseModel;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;

/**
 * @template T of BaseModel
 */
interface EntityMapperInterface
{
    public function support(BaseEntity $entity): bool;

    /**
     * @return T
     */
    public function toDomain(BaseEntity $entity);
}
