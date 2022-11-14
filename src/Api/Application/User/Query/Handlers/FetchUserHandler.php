<?php declare(strict_types=1);

namespace Api\Application\User\Query\Handlers;

use Api\Application\User\Query\Queries\FetchUserQuery;

class FetchUserHandler
{
    public function handle(FetchUserQuery $query)
    {
        echo "<pre>"; print_r($query); die;
    }
}
