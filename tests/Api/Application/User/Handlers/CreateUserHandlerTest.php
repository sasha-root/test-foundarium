<?php declare(strict_types=1);

namespace Tests\Api\Application\User\Handlers;

use Tests\TestCase;
use Generator;
use Api\UI\User\Http\Requests\PostUserRequest;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;

class CreateUserHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider createDataProvider
     */
    public function testCreate(array $data)
    {


        $request = new PostUserRequest();
        $request->json()->add($data);

        $command = new CreateUserCommand($request);

        /** @var CreateUserHandler $handler */
        $handler = $this->app->make(CreateUserHandler::class);
        $user = $handler->handle($command)->resolve();

        self::assertNotNull($user);
        self::assertArrayHasKey('id', $user);
        self::assertEquals($data['name'], $user['name']);
        self::assertEquals($data['email'], $user['email']);
    }

    public function createDataProvider(): Generator
    {
        yield [
            'data' => [
                'name' => 'Petr Ivanov',
                'email' => 'petr-ivanov@example.com',
                'password' => 'qwerty'
            ]
        ];
    }
}
