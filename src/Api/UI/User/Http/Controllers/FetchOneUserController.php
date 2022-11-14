<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\User\Query\Handlers\FetchUserHandler;
use Api\Application\User\Query\Queries\FetchUserQuery;

class FetchOneUserController extends Controller
{
    public function __construct(
        private FetchUserHandler $handler
    ) {

    }

    public function __invoke(int $user_id)
    {
        $query = new FetchUserQuery($user_id);
        return $this->handler->handle($query);
    }
}
