<?php

declare(strict_types=1);

namespace Application\Common\DTO;

use Domain\Common\Model\BaseModel;
use Domain\Common\ValueObjects\Pagination\PaginatedResult;

/**
 * @template T of BaseModel
 */
abstract readonly class BaseSearchResponse
{
    public bool $errors;
    public mixed $data;

    public int $totalItems;
    public int $totalPages;
    public int $page;
    public int $limit;

    /**
     * @param PaginatedResult<T> $paginatedResult
     */
    public function __construct(PaginatedResult $paginatedResult, bool $errors = false)
    {
        $this->errors = $errors;
        $this->page = $paginatedResult->page;
        $this->limit = $paginatedResult->limit;
        $this->totalItems = $paginatedResult->totalItems ?? count($paginatedResult->data);
        $this->totalPages = $paginatedResult->totalPages;
        $this->data = iterator_to_array($this->convertData($paginatedResult->data));
    }

    /**
     * @param BaseModel[] $dataToConvert
     *
     * @return iterable<array<string, mixed>>
     */
    abstract protected function convertData(array $dataToConvert): iterable;
}
