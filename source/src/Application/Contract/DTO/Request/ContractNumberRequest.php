<?php

declare(strict_types=1);

namespace Application\Contract\DTO\Request;

final readonly class ContractNumberRequest
{
    public function __construct(
        public string $contractNumber,
    ) {
    }
}
