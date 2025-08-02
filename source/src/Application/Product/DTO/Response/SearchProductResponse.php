<?php

declare(strict_types=1);

namespace Application\Product\DTO\Response;

use Application\Common\DTO\BaseSearchResponse;
use Domain\Product\Model\Product as ProductModel;

/**
 * @extends BaseSearchResponse<ProductModel>
 */
final readonly class SearchProductResponse extends BaseSearchResponse
{
    /**
     * @param array<ProductModel> $dataToConvert
     *
     * @return iterable<array<string, mixed>>
     */
    protected function convertData(array $dataToConvert): iterable
    {
        foreach ($dataToConvert as $item) {
            /* @phpstan-ignore-next-line */
            if (!$item instanceof ProductModel) {
                continue;
            }

            yield [
                'uuid' => $item->uuid,
                'nature' => $item->nature,
                'name' => $item->name,
                'supplier' => $item->supplier,
                'picture' => $item->picture,
                'description' => $item->description,
                'warning' => $item->warning,
                'supplierCode' => $item->supplierCode,
                'archivedAt' => $item->archivedAt,
                'crmId' => $item->crmId,
            ];
        }
    }
}
