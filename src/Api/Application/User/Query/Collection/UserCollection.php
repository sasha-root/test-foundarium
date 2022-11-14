<?php declare(strict_types=1);

namespace Api\Application\User\Query\Collection;

use Api\Application\User\Query\Views\UserView;
use Api\Application\Common\Query\Queries\ApplicationCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserCollection extends ApplicationCollection
{
    protected function getResourceCollection(LengthAwarePaginator $data): AnonymousResourceCollection
    {
        return UserView::collection($data);
    }
}
