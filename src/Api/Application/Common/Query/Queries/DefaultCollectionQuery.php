<?php declare(strict_types=1);

namespace Api\Application\Common\Query\Queries;

class DefaultCollectionQuery
{
    private ?array $pagination;

    private ?string $orderBy;

    public function __construct(array $data)
    {

    }

    public function getPagination(): ?array
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
