<?php

declare(strict_types=1);

namespace Infrastructure\Services\Mapper;

use Domain\User\Model\User as UserModel;
use Infrastructure\Doctrine\Entity\User as UserEntity;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;

/**
 * @implements EntityMapperInterface<UserModel>
 */
final readonly class UserMapper implements EntityMapperInterface
{
    public function support(BaseEntity $entity): bool
    {
        return $entity instanceof UserEntity;
    }

    /**
     * @param UserEntity $entity
     */
    public function toDomain(BaseEntity $entity): UserModel
    {
        return new UserModel(
            uuid: $entity->uuid,
            identifier: $entity->email,
            firstName: $entity->firstName,
            lastName: $entity->lastName,
            email: $entity->email,
            roles: $entity->roles,
        );
    }
}
