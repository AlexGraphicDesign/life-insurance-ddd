<?php

declare(strict_types=1);

namespace Application\User\DTO\Response;

use Application\Common\DTO\BaseResponse;
use Domain\User\Model\User as UserModel;

final readonly class UserCurrentResponse extends BaseResponse
{
    /**
     * @return array<string, string|array<string>>|null
     */
    protected function convertData(mixed $toSerialize): ?array
    {
        if (!$toSerialize instanceof UserModel) {
            return null;
        }

        return [
            'uuid' => $toSerialize->uuid,
            'email' => $toSerialize->email,
            'firstname' => $toSerialize->firstName,
            'lastname' => $toSerialize->lastName,
            'roles' => $toSerialize->roles,
        ];
    }
}
