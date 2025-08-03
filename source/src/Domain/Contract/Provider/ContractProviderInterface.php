<?php

declare(strict_types=1);

namespace Domain\Contract\Provider;

interface ContractProviderInterface
{

    public function getContractByNumber(string $contractnumber);
}
