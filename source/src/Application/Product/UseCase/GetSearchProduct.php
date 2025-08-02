<?php

declare(strict_types=1);

namespace Application\Product\UseCase;

use Application\Product\DTO\Request\SearchProductRequest;
use Application\Product\DTO\Response\SearchProductResponse;
use Domain\Product\Repository\ProductModelRepositoryInterface;

final readonly class GetSearchProduct
{
    public function __construct(
        private ProductModelRepositoryInterface $productRepository,
    ) {
    }

    public function execute(SearchProductRequest $searchQuery): SearchProductResponse
    {
        return new SearchProductResponse($this->productRepository->search($searchQuery->page, $searchQuery->limit));
    }
}
