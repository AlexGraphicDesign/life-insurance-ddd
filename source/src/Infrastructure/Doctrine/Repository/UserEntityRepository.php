<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Domain\User\Model\User as UserModel;
use Domain\User\Repository\UserModelRepositoryInterface;
use Infrastructure\Doctrine\Entity\User as UserEntity;
use Infrastructure\Services\Mapper\Mapper;

/**
 * @template T
 *
 * @extends ServiceEntityRepository<UserEntity>
 */
final class UserEntityRepository extends ServiceEntityRepository implements UserModelRepositoryInterface
{
    public function __construct(
        ManagerRegistry $managerRegistry,
        /** @var Mapper<UserModel> */
        private readonly Mapper $userMapper,
    ) {
        parent::__construct($managerRegistry, UserEntity::class);
    }

    public function findOneByEmail(?string $email): UserModel
    {
        $userEntity = $this->findOneBy(['email' => $email]);
        if (!$userEntity) {
            // TODO: gérer proprement les exceptions
            throw new EntityNotFoundException(sprintf('User not found with this email : "%s"', $email));
        }

        /* @var UserEntity $userEntity */
        return $this->userMapper->toDomain($userEntity);
    }
}
