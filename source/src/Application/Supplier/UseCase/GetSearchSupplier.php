<?php

declare(strict_types=1);

namespace Application\Supplier\UseCase;

use Application\Supplier\DTO\Request\SearchSupplierRequest;
use Application\Supplier\DTO\Response\SearchSupplierResponse;
use Domain\Supplier\Repository\SupplierModelRepositoryInterface;

final readonly class GetSearchSupplier
{
    public function __construct(
        private SupplierModelRepositoryInterface $supplierRepository,
    ) {
    }

    public function execute(SearchSupplierRequest $searchQuery): SearchSupplierResponse
    {
        return new SearchSupplierResponse($this->supplierRepository->search($searchQuery->page, $searchQuery->limit));
    }
}
