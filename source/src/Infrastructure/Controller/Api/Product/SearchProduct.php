<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\Product;

use Application\Product\DTO\Request\SearchProductRequest;
use Application\Product\UseCase\GetSearchProduct;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

final readonly class SearchProduct
{
    public function __construct(
        private GetSearchProduct $getSearchProduct,
    ) {
    }

    #[Route(path: 'product/search', name: self::class, methods: ['GET'])]
    public function __invoke(#[MapQueryString] SearchProductRequest $request): JsonResponse
    {
        return new JsonResponse($this->getSearchProduct->execute($request));
    }
}
