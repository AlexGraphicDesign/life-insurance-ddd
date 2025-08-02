<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Doctrine\Entity\Utility\BaseEntity;
use Infrastructure\Doctrine\Repository\SupplierEntityRepository;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: SupplierEntityRepository::class)]
class Supplier extends BaseEntity
{
    /** @var Collection<int, Product> */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'supplier', cascade: ['remove'])]
    #[MaxDepth(1)]
    public Collection $products;

    #[ORM\Column(type: 'string', length: 255)]
    public string $name;

    #[ORM\Column(type: 'string', length: 255)]
    public string $slug;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    public ?string $rgpd = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $rgpdLink = null;

    #[ORM\Column(type: 'boolean')]
    public bool $displayOnAdditional = false;

    #[ORM\Column(type: 'boolean')]
    public bool $displayOnArbitration = false;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function addProduct(Product $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->supplier = $this;
        }
    }
}
