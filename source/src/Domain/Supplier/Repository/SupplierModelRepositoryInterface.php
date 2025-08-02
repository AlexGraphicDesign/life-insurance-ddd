<?php

declare(strict_types=1);

namespace Domain\Supplier\Repository;

use Domain\Common\ValueObjects\Pagination\PaginatedResult;
use Domain\Supplier\Model\Supplier as SupplierModel;

interface SupplierModelRepositoryInterface
{
    /**
     * @return PaginatedResult<SupplierModel>
     */
    public function search(int $page, int $limit): PaginatedResult;
}
