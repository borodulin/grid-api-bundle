<?php

declare(strict_types=1);

namespace Borodulin\Bundle\GridApiBundle\GridApi\Sort;

class SortRequest implements SortRequestInterface
{
    private array $sortOrders;

    public function __construct(
        array $sortOrders
    ) {
        $this->sortOrders = $sortOrders;
    }

    public function getSortOrders(): array
    {
        return $this->sortOrders;
    }
}
