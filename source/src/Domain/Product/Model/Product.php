<?php

declare(strict_types=1);

namespace Domain\Product\Model;

use Domain\Common\Model\BaseModel;

class Product extends BaseModel
{
    public string $name {
        set {
            $this->name = $value;
        }
        get {
            return $this->name;
        }
    }

    public string $nature {
        set {
            $this->nature = $value;
        }
        get {
            return $this->nature;
        }
    }

    public string $supplier {
        set {
            $this->supplier = $value;
        }
        get {
            return $this->supplier;
        }
    }

    public string $picture {
        set {
            $this->picture = $value;
        }
        get {
            return $this->picture;
        }
    }

    public ?string $description {
        set {
            $this->description = $value ?: null;
        }
        get {
            return $this->description;
        }
    }

    public ?string $warning {
        set {
            $this->warning = $value ?: null;
        }
        get {
            return $this->warning;
        }
    }

    public string $supplierCode {
        set {
            $this->supplierCode = $value;
        }
        get {
            return $this->supplierCode;
        }
    }

    public ?\DateTime $archivedAt {
        set {
            $this->archivedAt = $value;
        }
        get {
            return $this->archivedAt;
        }
    }

    public int $crmId {
        set {
            $this->crmId = $value;
        }
        get {
            return $this->crmId;
        }
    }

    public function __construct(
        string $uuid,
        string $nature,
        string $name,
        string $supplier,
        string $picture,
        ?string $description,
        ?string $warning,
        string $supplierCode,
        ?\DateTime $archivedAt,
        int $crmId,
    ) {
        $this->nature = $nature;
        $this->name = $name;
        $this->supplier = $supplier;
        $this->picture = $picture;
        $this->description = $description;
        $this->warning = $warning;
        $this->supplierCode = $supplierCode;
        $this->archivedAt = $archivedAt;
        $this->crmId = $crmId;
        parent::__construct($uuid);
    }
}
