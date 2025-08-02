<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\User;

use Application\User\DTO\Response\UserCurrentResponse;
use Application\User\UseCase\GetCurrentUser;
use Infrastructure\Doctrine\Entity\User as UserEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final readonly class UserCurrent
{
    public function __construct(
        private GetCurrentUser $getCurrentUser,
    ) {
    }

    #[Route(path: 'user/current', name: self::class, methods: ['GET'])]
    public function __invoke(#[CurrentUser] ?UserEntity $user, Request $request): JsonResponse
    {
        return new JsonResponse((array) new UserCurrentResponse($this->getCurrentUser->execute($user?->email)));
    }
}
