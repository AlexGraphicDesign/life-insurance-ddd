<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;
use Infrastructure\Doctrine\Repository\ProductEntityRepository;

#[ORM\Entity(repositoryClass: ProductEntityRepository::class)]
class Product extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Supplier::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    public Supplier $supplier;

    #[ORM\Column(type: 'string', length: 255)]
    public string $nature;

    #[ORM\Column(type: 'string', length: 255)]
    public string $name;

    #[ORM\Column(type: 'string', length: 255)]
    public string $picture;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $description = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    public ?string $warning = null;

    #[ORM\Column(type: 'string', length: 255)]
    public string $supplierCode;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTime $archivedAt = null;

    #[ORM\Column(type: 'integer')]
    public int $crmId;

    public function setSupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
        $supplier->addProduct($this);
    }
}
