<?php

declare(strict_types=1);

namespace Infrastructure\Controller\Api\Contract;

use Application\Contract\UseCase\GetInformationsContract;
use Symfony\Component\Routing\Annotation\Route;

final readonly class Informations
{
    public function __construct(
        private GetInformationsContract $getInformationsContract,
    ) {
    }

    #[Route(path: '/supplier-1/contrats/{contractNumber}', name: self::class, methods: ['GET'])]
    public function __invoke(string $supplier, string $contractNumber)
    {
        return $this->getInformationsContract->execute($supplier, $contractNumber);
    }
}
