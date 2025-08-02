<?php

declare(strict_types=1);

namespace Domain\User\Repository;

use Domain\User\Model\User as UserModel;

interface UserModelRepositoryInterface
{
    public function findOneByEmail(?string $email): ?UserModel;
}
