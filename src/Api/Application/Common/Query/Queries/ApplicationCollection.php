<?php declare(strict_types=1);

namespace Api\Application\Common\Query\Queries;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class ApplicationCollection
{
    protected LengthAwarePaginator $dataWithPagination;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->dataWithPagination = $paginator;
    }

    abstract protected function getResourceCollection(LengthAwarePaginator $data): AnonymousResourceCollection;

    protected function getPageInfo(): array
    {
        return [
            'total' => $this->dataWithPagination->total(),
            'last_page' => $this->dataWithPagination->lastPage(),
            'per_page' =>  $this->dataWithPagination->perPage(),
            'current_page' => $this->dataWithPagination->currentPage()
        ];
    }

    public function toArray(): array
    {
        return [
            'list' => $this->getResourceCollection($this->dataWithPagination)->resolve(),
            'page_info' => $this->getPageInfo()
        ];
    }
}

