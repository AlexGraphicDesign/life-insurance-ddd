<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Common\ValueObjects\Pagination\PaginatedResult;
use Domain\Supplier\Model\Supplier as SupplierModel;
use Domain\Supplier\Repository\SupplierModelRepositoryInterface;
use Infrastructure\Doctrine\Entity\Supplier as SupplierEntity;
use Infrastructure\Services\Paginator\PaginatorService;

/**
 * @template T
 *
 * @extends ServiceEntityRepository<SupplierEntity>
 */
final class SupplierEntityRepository extends ServiceEntityRepository implements SupplierModelRepositoryInterface
{
    public function __construct(
        ManagerRegistry $managerRegistry,
        /** @var PaginatorService<SupplierModel> */
        private readonly PaginatorService $paginatorService,
    ) {
        parent::__construct($managerRegistry, SupplierEntity::class);
    }

    /** @return PaginatedResult<SupplierModel> */
    public function search(int $page, int $limit): PaginatedResult
    {
        /** @var Query<int, SupplierEntity> $query */
        $query = $this->createQueryBuilder('s')
                ->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit)
                ->getQuery();

        return $this->paginatorService->paginate($query, $page, $limit);
    }
}
