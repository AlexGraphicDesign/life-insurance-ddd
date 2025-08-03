<?php

declare(strict_types=1);

namespace Infrastructure\Provider\Supplier1\Data;

use Domain\Contract\Provider\ContractProviderInterface;

final readonly class Supplier1ContractData implements ContractProviderInterface
{
    public function getContractByNumber(string $contractnumber)
    {
        // TODO: Implement contract retrieval logic
    }
}
