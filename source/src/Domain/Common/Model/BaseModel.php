<?php

declare(strict_types=1);

namespace Domain\Common\Model;

abstract class BaseModel
{
    public string $uuid {
        set {
            $this->uuid = $value;
        }
        get {
            return $this->uuid;
        }
    }

    public function __construct(
        string $uuid,
    ) {
        $this->uuid = $uuid;
    }
}
