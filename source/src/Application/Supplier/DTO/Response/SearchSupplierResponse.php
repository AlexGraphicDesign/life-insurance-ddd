<?php

declare(strict_types=1);

namespace Application\Supplier\DTO\Response;

use Application\Common\DTO\BaseSearchResponse;
use Domain\Supplier\Model\Supplier as SupplierModel;

/**
 * @extends BaseSearchResponse<SupplierModel>
 */
final readonly class SearchSupplierResponse extends BaseSearchResponse
{
    /**
     * @param array<SupplierModel> $dataToConvert
     *
     * @return iterable<array<string, mixed>>
     */
    protected function convertData(array $dataToConvert): iterable
    {
        foreach ($dataToConvert as $item) {
            /* @phpstan-ignore-next-line */
            if (!$item instanceof SupplierModel) {
                continue;
            }

            yield [
                'uuid' => $item->uuid,
                'products' => $item->products,
                'name' => $item->name,
                'slug' => $item->slug,
                'rgpd' => $item->rgpd,
                'rgpdLink' => $item->rgpdLink,
                'displayOnAdditional' => $item->displayOnAdditional,
                'displayOnArbitration' => $item->displayOnArbitration,
            ];
        }
    }
}
