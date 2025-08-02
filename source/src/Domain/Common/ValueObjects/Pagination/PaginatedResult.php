<?php

declare(strict_types=1);

namespace Domain\Common\ValueObjects\Pagination;

use Domain\Common\Model\BaseModel;

/**
 * @template T of BaseModel
 */
final readonly class PaginatedResult
{
    public function __construct(
        /**
         * @var T[] $data
         */
        public array $data,
        public int $page,
        public int $limit,
        public int $totalItems,
        public int $totalPages,
    ) {
    }
}
