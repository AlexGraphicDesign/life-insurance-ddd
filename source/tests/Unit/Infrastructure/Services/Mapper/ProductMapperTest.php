<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Services\Mapper;

use Domain\Product\Model\Product as ProductModel;
use Infrastructure\Doctrine\Entity\Product as ProductEntity;
use Infrastructure\Doctrine\Entity\Supplier as SupplierEntity;
use Infrastructure\Services\Mapper\ProductMapper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ProductMapperTest extends TestCase
{
    private ProductMapper $mapper;

    public static function provideProductData(): array
    {
        $supplierEntity = new SupplierEntity();
        $supplierEntity->uuid = 'unit-test-supplier-uuid';

        $productEntity = new ProductEntity();
        $productEntity->uuid = 'unit-test-product-uuid';
        $productEntity->nature = 'unit-test-product-nature';
        $productEntity->name = 'Unit Test Product';
        $productEntity->supplier = $supplierEntity;
        $productEntity->picture = 'unit-test-product-picture.jpg';
        $productEntity->description = 'This is a unit test product description.';
        $productEntity->warning = 'This is a unit test product warning.';
        $productEntity->supplierCode = 'unit-test-supplier-code';
        $productEntity->archivedAt = null;
        $productEntity->crmId = 123;

        $expectedModel = new ProductModel(
            uuid: 'unit-test-product-uuid',
            nature: 'unit-test-product-nature',
            name: 'Unit Test Product',
            supplier: 'unit-test-supplier-uuid',
            picture: 'unit-test-product-picture.jpg',
            description: 'This is a unit test product description.',
            warning: 'This is a unit test product warning.',
            supplierCode: 'unit-test-supplier-code',
            archivedAt: null,
            crmId: 123,
        );

        return [
            'productEntity' => [$productEntity, $expectedModel],
        ];
    }

    public function setUp(): void
    {
        $this->mapper = new ProductMapper();
    }

    #[DataProvider('provideProductData')]
    public function testMapProductEntityToProductModel(ProductEntity $input, ProductModel $expected): void
    {
        $domain = $this->mapper->toDomain($input);

        $this->assertEquals($expected, $domain);
    }
}
