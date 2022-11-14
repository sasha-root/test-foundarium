<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Handlers;

use Api\Application\Car\Query\Queries\FetchCarQuery;

class FetchCarHandler
{
    public function handle(FetchCarQuery $query)
    {
        echo "<pre>"; print_r($query); die;
    }
}
