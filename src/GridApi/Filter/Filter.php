<?php

declare(strict_types=1);

namespace Borodulin\GridApiBundle\GridApi\Filter;

class Filter implements FilterInterface
{
    private array $filters;

    public function __construct(
        array $filters
    ) {
        $this->filters = $filters;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }
}
