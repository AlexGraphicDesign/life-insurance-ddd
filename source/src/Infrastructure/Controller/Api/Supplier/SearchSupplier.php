<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\Supplier;

use Application\Supplier\DTO\Request\SearchSupplierRequest;
use Application\Supplier\UseCase\GetSearchSupplier;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

final readonly class SearchSupplier
{
    public function __construct(
        private GetSearchSupplier $getSearchSupplier,
    ) {
    }

    #[Route(path: 'supplier/search', name: self::class, methods: ['GET'])]
    public function __invoke(#[MapQueryString] SearchSupplierRequest $request): JsonResponse
    {
        return new JsonResponse($this->getSearchSupplier->execute($request));
    }
}
