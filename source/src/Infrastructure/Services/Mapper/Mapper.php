<?php

declare(strict_types=1);

namespace Infrastructure\Services\Mapper;

use Domain\Common\Model\BaseModel;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;

/**
 * @template T of BaseModel
 */
final readonly class Mapper
{
    /**
     * @param iterable<EntityMapperInterface<T>> $entityMappers
     */
    public function __construct(
        private iterable $entityMappers,
    ) {
    }

    /**
     * @return T
     *
     * @throws \Exception
     */
    public function toDomain(BaseEntity $entity)
    {
        foreach ($this->entityMappers as $entityMapper) {
            if ($entityMapper->support($entity)) {
                /* @var T $baseModel */
                return $entityMapper->toDomain($entity);
            }
        }

        // TODO: gérer proprement les exceptions
        throw new \Exception('No mapper found for entity '.$entity::class);
    }
}
