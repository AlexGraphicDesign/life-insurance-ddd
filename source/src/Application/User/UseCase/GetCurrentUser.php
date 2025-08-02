<?php

declare(strict_types=1);

namespace Application\User\UseCase;

use Domain\User\Model\User as UserModel;
use Domain\User\Repository\UserModelRepositoryInterface;

final readonly class GetCurrentUser
{
    public function __construct(
        private UserModelRepositoryInterface $userRepository,
    ) {
    }

    public function execute(?string $email): ?UserModel
    {
        return $this->userRepository->findOneByEmail($email);
    }
}
