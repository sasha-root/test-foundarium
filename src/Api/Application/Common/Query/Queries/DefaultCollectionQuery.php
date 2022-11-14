<?php declare(strict_types=1);

namespace Api\Application\Common\Query\Queries;

use Api\Domain\Common\Model\PaginationFilter;

class DefaultCollectionQuery
{
    private PaginationFilter $pagination;

    private ?string $orderBy;

    public function __construct(array $data)
    {
        $this->orderBy = $data['order'] ?? null;
        $this->pagination = PaginationFilter::createFromArray($data['pagination'] ?? []);
    }

    public function getPagination(): PaginationFilter
    {
        return $this->pagination;
    }

    public function getOrderBy(): ?array
    {
        $sortOrders = [
            'new_first'  => ['id', 'desc'],
            'old_first'  => ['id', 'asc']
        ];

        return $sortOrders[$this->orderBy] ?? null;
    }
}
