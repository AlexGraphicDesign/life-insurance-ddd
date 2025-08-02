<?php

declare(strict_types=1);

namespace Domain\Supplier\Model;

use Domain\Common\Model\BaseModel;

class Supplier extends BaseModel
{
    public string $name {
        set {
            $this->name = $value;
        }
        get {
            return $this->name;
        }
    }

    /**
     * @var array<int, string>
     */
    public array $products {
        set {
            $this->products = $value;
        }
        get {
            return $this->products;
        }
    }

    public string $slug {
        set {
            $this->slug = $value;
        }
        get {
            return $this->slug;
        }
    }

    public ?string $rgpd {
        set {
            $this->rgpd = $value ?: null;
        }
        get {
            return $this->rgpd;
        }
    }

    public ?string $rgpdLink {
        set {
            $this->rgpdLink = $value ?: null;
        }
        get {
            return $this->rgpdLink;
        }
    }

    public bool $displayOnAdditional {
        set {
            $this->displayOnAdditional = $value;
        }
        get {
            return $this->displayOnAdditional;
        }
    }

    public bool $displayOnArbitration {
        set {
            $this->displayOnArbitration = $value;
        }
        get {
            return $this->displayOnArbitration;
        }
    }

    /**
     * @param array<int, string> $products
     */
    public function __construct(
        string $uuid,
        string $name,
        array $products,
        string $slug,
        ?string $rgpd,
        ?string $rgpdLink,
        bool $displayOnAdditional,
        bool $displayOnArbitration,
    ) {
        $this->name = $name;
        $this->products = $products;
        $this->slug = $slug;
        $this->rgpd = $rgpd;
        $this->rgpdLink = $rgpdLink;
        $this->displayOnAdditional = $displayOnAdditional;
        $this->displayOnArbitration = $displayOnArbitration;
        parent::__construct($uuid);
    }
}
