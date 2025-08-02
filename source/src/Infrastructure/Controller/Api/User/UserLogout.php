<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class UserLogout
{
    #[Route(path: 'logout', name: 'logout', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
