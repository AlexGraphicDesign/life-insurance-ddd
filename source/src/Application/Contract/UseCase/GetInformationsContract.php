<?php

declare(strict_types=1);

namespace Application\Contract\UseCase;

final readonly class GetInformationsContract
{
    public function execute(string $supplier, string $contractNumber)
    {
        dd($supplier, $contractNumber);
    }
}
