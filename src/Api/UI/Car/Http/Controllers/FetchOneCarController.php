<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\Application\Car\Query\Handlers\FetchCarHandler;
use Api\Application\Car\Query\Queries\FetchCarQuery;
use Api\UI\Common\Http\Controllers\Controller;

class FetchOneCarController extends Controller
{
    public function __construct(
        private FetchCarHandler $handler
    ) {

    }

    public function __invoke(int $car_id)
    {
        $query = new FetchCarQuery($car_id);
        return $this->handler->handle($query);
    }
}
