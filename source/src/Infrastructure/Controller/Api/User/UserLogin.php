<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\User;

use Application\User\DTO\Response\UserResponse;
use Infrastructure\Doctrine\Entity\User as UserEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final readonly class UserLogin
{
    #[Route(path: 'user/login', name: 'login', methods: ['POST'])]
    public function __invoke(#[CurrentUser] ?UserEntity $user, Request $request): JsonResponse
    {
        return new JsonResponse((array) new UserResponse($user));
    }
}
