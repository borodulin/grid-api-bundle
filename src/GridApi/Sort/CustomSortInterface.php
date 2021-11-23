<?php

declare(strict_types=1);

namespace Borodulin\Bundle\GridApiBundle\GridApi\Sort;

interface CustomSortInterface
{
    /**
     * Массив вида
     * ['sorting_query_string' => 'alias.field'].
     * alias.field - DQL выражение.
     *
     * @example ['customer_id' => 'customer.id']
     *
     * @return string[]
     */
    public function getSortFields(): array;
}