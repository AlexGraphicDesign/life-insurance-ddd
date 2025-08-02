<?php

declare(strict_types=1);

namespace Application\Common\DTO;

final readonly class ErrorResponse
{
    /**
     * @param array<int|string, mixed> $errors
     * @param array<int|string, mixed> $data
     */
    public function __construct(public string $message, public array $errors, public array $data = [])
    {
    }
}
