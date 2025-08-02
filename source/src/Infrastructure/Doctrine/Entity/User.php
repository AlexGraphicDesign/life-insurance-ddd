<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;
use Infrastructure\Doctrine\Entity\Utility\Timestampable;
use Infrastructure\Doctrine\Repository\UserEntityRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserEntityRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User extends BaseEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Timestampable;

    #[ORM\Column(type: 'string', length: 255)]
    public string $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    public string $lastName;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    public string $email;

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    public array $roles = [];

    #[ORM\Column(type: 'string')]
    public string $password;

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        if (empty($this->email)) {
            throw new \InvalidArgumentException('User identifier (email) cannot be empty.');
        }

        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
