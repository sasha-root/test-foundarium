<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Collection;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Api\Application\Car\Query\Views\CarView;
use Api\Application\Common\Query\Queries\ApplicationCollection;

class CarCollection extends ApplicationCollection
{
    protected function getResourceCollection(LengthAwarePaginator $data): AnonymousResourceCollection
    {
        return CarView::collection($data);
    }
}
