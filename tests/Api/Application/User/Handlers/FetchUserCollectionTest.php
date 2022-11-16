<?php declare(strict_types=1);

namespace Tests\Api\Application\User\Handlers;

use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\Domain\CarRental\Model\CarRental;
use Api\Domain\User\Model\User;
use Api\UI\User\Http\Requests\PostUserRequest;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Generator;

class FetchUserCollectionTest extends TestCase
{
    /**
     * @param array $dataItems
     * @return void
     * @dataProvider fetchDataProvider
     */
    public function testFetchCollection(array $dataItems): void
    {
        DB::statement("SET foreign_key_checks=0");
        CarRental::truncate();
        User::truncate();
        DB::statement("SET foreign_key_checks=1");

        foreach ($dataItems as $data) {
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
    }

    public function fetchDataProvider(): Generator
    {
        yield [
            'dataItems' => [
                [
                    'name' => 'Petr Ivanov',
                    'email' => 'petr-ivanov@example.com',
                    'password' => 'qwerty'
                ],
                [
                    'name' => 'Ivan Petrov',
                    'email' => 'ivan-petrov@example.com',
                    'password' => 'qwerty'
                ],
                [
                    'name' => 'Bob Henderson',
                    'email' => 'bob-henderson@example.com',
                    'password' => 'qwerty'
                ]
            ]
        ];
    }
}
