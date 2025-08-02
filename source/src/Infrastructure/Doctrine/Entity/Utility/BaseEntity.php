<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity\Utility;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 26)]
    public string $uuid;

    #[ORM\PrePersist]
    public function setUuid(): void
    {
        if (!$this->uuid) {
            $this->uuid = new UuidV4()->toBase32();
        }
    }
}
