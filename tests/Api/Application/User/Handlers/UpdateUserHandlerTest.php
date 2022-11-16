<?php declare(strict_types=1);

namespace Tests\Api\Application\User\Handlers;

use Api\Domain\User\Exception\UserNotFoundException;
use Tests\TestCase;
use Generator;
use Api\Domain\User\Model\User;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Commands\UpdateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\Application\User\Command\Handlers\UpdateUserHandler;
use Api\UI\User\Http\Requests\PostUserRequest;
use Api\UI\User\Http\Requests\PutUserRequest;

class UpdateUserHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider updateDataProvider
     * @throws UserNotFoundException
     */
    public function testUpdate(array $data): void
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

        $putUserRequest = new PutUserRequest();
        $putUserRequest->json()->add([...$data, ...['user_id' => $id]]);

        $commandUserUpdate = new UpdateUserCommand($putUserRequest);

        /** @var UpdateUserHandler $updateCarHandler */
        $updateCarHandler = $this->app->make(UpdateUserHandler::class);
        $user = $updateCarHandler->handle($commandUserUpdate);

        self::assertNotNull($user);
        self::assertArrayHasKey('id', $user);

        /** @var User $userModel */
        $userModel = User::query()->where(['id' => $user['id']])->first();

        self::assertEquals($data['name'], $userModel->name);
        self::assertEquals($data['email'], $userModel->email);
    }

    public function updateDataProvider(): Generator
    {
        yield [
            'data' => [
                'name' => 'Bob Henderson',
                'email' => 'bob-henderson@gmail.com'
            ]
        ];
    }
}

