<?php

declare(strict_types=1);

namespace Domain\User\Enum;

enum Role: string
{
    case APPLICATION = 'ROLE_APPLICATION';
    case ADMIN = 'ROLE_ADMIN';
    case ADVISER = 'ROLE_ADVISER';
    case ADVISER_LIMITED = 'ROLE_ADVISER_LIMITED';
    case EXTERNAL = 'ROLE_EXTERNAL';
}
