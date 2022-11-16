<?php declare(strict_types=1);

namespace Tests\Api\Application\User\Handlers;

use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\Application\User\Query\Handlers\FetchUserHandler;
use Api\Application\User\Query\Queries\FetchUserQuery;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Domain\User\Model\User;
use Api\UI\User\Http\Requests\PostUserRequest;
use Tests\TestCase;
use Generator;

class FetchUserHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider fetchDataProvider
     * @throws UserNotFoundException
     */
    public function testFetch(array $data): void
    {
        /** @var User|null $user */
        $postUserRequest = new PostUserRequest();
        $postUserRequest->json()->add($data);

        $commandUserCreate = new CreateUserCommand($postUserRequest);

        /** @var CreateUserHandler $createHandler */
        $createHandler = $this->app->make(CreateUserHandler::class);
        $user = $createHandler->handle($commandUserCreate)->resolve();
        $id = (int)$user['id'];

        $fetchUserQuery = new FetchUserQuery($id);

        /** @var FetchUserHandler $fetchUserHandler */
        $fetchUserHandler = $this->app->make(FetchUserHandler::class);
        $user = $fetchUserHandler->handle($fetchUserQuery)->resolve();

        self::assertNotNull($user);
        self::assertArrayHasKey('id', $user);
        self::assertEquals($data['name'], $user['name']);
        self::assertEquals($data['email'], $user['email']);
    }

    public function fetchDataProvider(): Generator
    {
        yield [
            'data' => [
                'name' => 'Ivan Petrov',
                'email' => 'ivan-petrov@mail.com',
                'password' => 'qwerty'
            ]
        ];
    }
}
