<?php

declare(strict_types=1);

namespace Application\Common\DTO;

abstract readonly class BaseResponse
{
    public bool $errors;

    /**
     * @var array<mixed>|string|float|int|null
     */
    public mixed $data;

    public function __construct(mixed $toSerialize, bool $errors = false)
    {
        $this->errors = $errors;
        $this->data = $this->convertData($toSerialize);
    }

    /**
     * @return array<mixed>|string|float|int|null
     */
    abstract protected function convertData(mixed $toSerialize): mixed;
}
