<?php

namespace Infrastructure\Services\Paginator;

use Application\Common\Services\Paginator\PaginatorServiceInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domain\Common\Model\BaseModel;
use Domain\Common\ValueObjects\Pagination\PaginatedResult;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;
use Infrastructure\Services\Mapper\Mapper;

/**
 * @template T of BaseModel
 *
 * @implements PaginatorServiceInterface<T>
 */
final readonly class PaginatorService implements PaginatorServiceInterface
{
    public function __construct(
        /** @var Mapper<T> */
        private Mapper $entityMapper,
    ) {
    }

    /**
     * @return PaginatedResult<T>
     */
    public function paginate(Query $query, int $page, int $limit): PaginatedResult
    {
        $paginator = new Paginator($query, true);
        $totalItems = $paginator->count();
        $data = $this->convertEntityToDomain($paginator);

        return new PaginatedResult(
            data: $data,
            page: $page,
            limit: $limit,
            totalItems: $totalItems,
            totalPages: (int) ceil($totalItems / $limit),
        );
    }

    /**
     * @param Paginator<object> $paginator
     *
     * @return array<int, T>
     */
    private function convertEntityToDomain(Paginator $paginator): array
    {
        /* @var array<int, T> */
        return array_map(
            fn ($modelEntity) => $this->entityMapper->toDomain(
                $modelEntity instanceof BaseEntity ?
                    $modelEntity
                    : throw new \InvalidArgumentException('L\'entité n\'est pas un BaseEntity')
            ),
            iterator_to_array($paginator)
        );
    }
}
