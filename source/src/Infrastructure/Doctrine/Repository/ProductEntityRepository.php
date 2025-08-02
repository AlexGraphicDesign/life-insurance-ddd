<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Common\ValueObjects\Pagination\PaginatedResult;
use Domain\Product\Model\Product as ProductModel;
use Domain\Product\Repository\ProductModelRepositoryInterface;
use Infrastructure\Doctrine\Entity\Product as ProductEntity;
use Infrastructure\Services\Paginator\PaginatorService;

/**
 * @template T
 *
 * @extends ServiceEntityRepository<ProductEntity>
 */
final class ProductEntityRepository extends ServiceEntityRepository implements ProductModelRepositoryInterface
{
    public function __construct(
        ManagerRegistry $managerRegistry,
        /** @var PaginatorService<ProductModel> */
        private readonly PaginatorService $paginatorService,
    ) {
        parent::__construct($managerRegistry, ProductEntity::class);
    }

    /** @return PaginatedResult<ProductModel> */
    public function search(int $page, int $limit): PaginatedResult
    {
        /** @var Query<int, ProductEntity> $query */
        $query = $this->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        return $this->paginatorService->paginate($query, $page, $limit);
    }
}
