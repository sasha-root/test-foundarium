<?php declare(strict_types=1);

namespace Api\Application\CarRental\Query\Collection;

use Api\Application\CarRental\Query\Views\CarRentalView;
use Api\Application\Common\Query\Queries\ApplicationCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarRentalCollection extends ApplicationCollection
{
    protected function getResourceCollection(LengthAwarePaginator $data): AnonymousResourceCollection
    {
        return CarRentalView::collection($data);
    }
}
