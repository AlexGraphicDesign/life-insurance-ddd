<?php

declare(strict_types=1);

namespace Domain\User\Model;

use Domain\Common\Model\BaseModel;

class User extends BaseModel
{
    public string $firstName {
        get {
            return $this->firstName;
        }
        set {
            $this->firstName = $value;
        }
    }

    public string $lastName {
        get {
            return $this->lastName;
        }
        set {
            $this->lastName = $value;
        }
    }

    public string $identifier {
        get {
            return $this->identifier;
        }
        set {
            $this->identifier = $value;
        }
    }

    public string $email {
        get {
            return $this->email;
        }
        set {
            $this->email = $value;
        }
    }

    /** @var array<string> */
    public array $roles {
        get {
            return $this->roles;
        }
        set {
            $this->roles = $value;
        }
    }

    /**
     * @param array<string> $roles
     */
    public function __construct(
        string $uuid,
        string $identifier,
        string $firstName,
        string $lastName,
        string $email,
        array $roles,
    ) {
        $this->identifier = $identifier;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->roles = $roles;
        parent::__construct($uuid);
    }
}
