<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\User\Query\Handlers\FetchUserHandler;
use Api\Application\User\Query\Queries\FetchUserQuery;
use Api\UI\User\Http\Requests\FetchUserRequest;
use Illuminate\Http\JsonResponse;
use Api\Domain\User\Exception\UserNotFoundException;

class FetchOneUserController extends Controller
{
    public function __construct(
        private readonly FetchUserHandler $handler
    ) {

    }

    /**
     * @param FetchUserRequest $request
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function __invoke(FetchUserRequest $request): JsonResponse
    {
        $query = new FetchUserQuery($request->getUserId());
        return response()->json($this->handler->handle($query));
    }
}
