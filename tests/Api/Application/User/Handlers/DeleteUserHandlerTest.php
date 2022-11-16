<?php declare(strict_types=1);

namespace Tests\Api\Application\User\Handlers;

use Tests\TestCase;
use Generator;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Commands\DeleteUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\Application\User\Command\Handlers\DeleteUserHandler;
use Api\Domain\User\Exception\UserNotAvailableDeleteException;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Domain\User\Model\User;
use Api\UI\User\Http\Requests\PostUserRequest;

class DeleteUserHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider deleteDataProvider
     * @throws UserNotAvailableDeleteException|UserNotFoundException
     */
    public function testDelete(array $data): void
    {
        /** @var User|null $user */
        if ($user = User::first()) {
            $id = $user->id;
        } else {
            $postUserRequest = new PostUserRequest();
            $postUserRequest->json()->add($data);

            $commandUserCreate = new CreateUserCommand($postUserRequest);

            /** @var CreateUserHandler $createUserHandler */
            $createUserHandler = $this->app->make(CreateUserHandler::class);
            $user = $createUserHandler->handle($commandUserCreate)->resolve();
            $id = (int)$user['id'];
        }

        $deleteCommand = new DeleteUserCommand($id);

        /** @var DeleteUserHandler $deleteUserHandler */
        $deleteUserHandler = $this->app->make(DeleteUserHandler::class);
        $deleteUserHandler->handle($deleteCommand);

        $result = User::query()->where(['id' => $id])->first();
        $this->assertNull($result);
    }

    public function deleteDataProvider(): Generator
    {
        yield [
            'data' => [
                'name' => 'Petr Ivanov',
                'email' => 'example@example.com',
                'password' => 'qwerty'
            ]
        ];
    }
}
