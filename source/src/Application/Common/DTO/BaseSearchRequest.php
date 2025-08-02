<?php

declare(strict_types=1);

namespace Application\Common\DTO;

abstract class BaseSearchRequest
{
    public int $page = 1;

    public int $limit = 10;
}
