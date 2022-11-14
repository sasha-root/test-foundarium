<?php declare(strict_types=1);

namespace Api\Domain\Common\Model;

final class PaginationFilter
{
    private const DEFAULT_PAGE = 1;

    private const DEFAULT_LIMIT = 20;

    private int $page;

    private int $limit;

    private function __construct()
    {

    }

    public static function createFromArray(array $data): self
    {
        $paginationFilter = new self();
        $paginationFilter->page = (isset($data['page']) && is_numeric($data['page'])) ? $data['page'] : self::DEFAULT_PAGE;
        $paginationFilter->limit = (isset($data['limit']) && is_numeric($data['limit'])) ? $data['limit'] : self::DEFAULT_LIMIT;
        return $paginationFilter;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
