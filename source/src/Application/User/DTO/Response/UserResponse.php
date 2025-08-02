<?php

declare(strict_types=1);

namespace Application\User\DTO\Response;

use Application\Common\DTO\BaseResponse;
use Infrastructure\Doctrine\Entity\User as UserEntity;

final readonly class UserResponse extends BaseResponse
{
    /**
     * @return array<string, string>|null
     */
    protected function convertData(mixed $toSerialize): ?array
    {
        if (!$toSerialize instanceof UserEntity) {
            return null;
        }

        return [
            'uuid' => $toSerialize->uuid,
        ];
    }
}
