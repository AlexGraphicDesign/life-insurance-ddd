<?php

declare(strict_types=1);

namespace Domain\Common\Model;

abstract class BaseContract extends BaseModel
{
    public string $supplier {
        set {
            $this->supplier = $value;
        }
        get {
            return $this->supplier;
        }
    }
}
