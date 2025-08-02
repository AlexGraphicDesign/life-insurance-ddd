<?php

declare(strict_types=1);

namespace Domain\Product\Repository;

use Domain\Common\ValueObjects\Pagination\PaginatedResult;
use Domain\Product\Model\Product as ProductModel;

interface ProductModelRepositoryInterface
{
    /**
     * @return PaginatedResult<ProductModel>
     */
    public function search(int $page, int $limit): PaginatedResult;
}
