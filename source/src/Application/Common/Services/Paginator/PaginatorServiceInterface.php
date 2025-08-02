<?php

declare(strict_types=1);

namespace Application\Common\Services\Paginator;

use Doctrine\ORM\Query;
use Domain\Common\Model\BaseModel;
use Domain\Common\ValueObjects\Pagination\PaginatedResult;

/**
 * @template T of BaseModel
 */
interface PaginatorServiceInterface
{
    /**
     * @param Query<int, object> $query
     *
     * @return PaginatedResult<T>
     */
    public function paginate(Query $query, int $page, int $limit): PaginatedResult;
}
