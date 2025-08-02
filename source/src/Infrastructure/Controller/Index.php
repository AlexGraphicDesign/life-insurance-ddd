<?php

declare(strict_types=1);

namespace Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final readonly class Index
{
    #[Route('/', name: Index::class)]
    public function __invoke(Environment $environment, Request $request): Response
    {
        return new Response($environment->render(
            'base.html.twig',
            []
        ), Response::HTTP_OK);
    }
}
