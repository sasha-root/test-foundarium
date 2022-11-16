<?php declare(strict_types=1);

namespace Tests\Api\Application\CarRental\Handlers;

use Tests\TestCase;
use Generator;
use Api\Domain\Car\Model\Car;
use Api\Domain\CarRental\Model\CarRental;
use Api\Domain\User\Model\User;
use Illuminate\Support\Facades\DB;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\Application\CarRental\Command\Commands\CreateCarRentalCommand;
use Api\Application\CarRental\Command\Handlers\CreateCarRentalHandler;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\UI\CarRental\Http\Requests\PostCarRentalRequest;
use Api\UI\User\Http\Requests\PostUserRequest;

class CreateCarRentalTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider createDataProvider
     */
    public function testCreate(array $data): void
    {
        DB::statement("SET foreign_key_checks=0");
        CarRental::truncate();
        Car::truncate();
        User::truncate();
        DB::statement("SET foreign_key_checks=1");

        $postUserRequest = new PostUserRequest();
        $postUserRequest->json()->add($data['user']);

        $commandUserCreate = new CreateUserCommand($postUserRequest);

        /** @var CreateUserHandler $createHandler */
        $createHandler = $this->app->make(CreateUserHandler::class);
        $user = $createHandler->handle($commandUserCreate)->resolve();
        $user_id = (int)$user['id'];

        $postCarRequest = new PostCarRequest();
        $postCarRequest->json()->add($data['car']);

        $commandCarCreate = new CreateCarCommand($postCarRequest);

        /** @var CreateCarHandler $createCarHandler */
        $createCarHandler = $this->app->make(CreateCarHandler::class);
        $car = $createCarHandler->handle($commandCarCreate)->resolve();
        $car_id = $car['id'];

        $postCarRentalRequest = new PostCarRentalRequest();
        $postCarRentalRequest->json()->add(['car_id' => $car_id, 'user_id' => $user_id]);

        $commandCarRentalCreate = new CreateCarRentalCommand($postCarRentalRequest);

        /** @var CreateCarRentalHandler $createCarRentalHandler */
        $createCarRentalHandler = $this->app->make(CreateCarRentalHandler::class);
        $carRental = $createCarRentalHandler->handle($commandCarRentalCreate)->resolve();

        $car = $carRental['car'];
        self::assertNotNull($car);
        self::assertArrayHasKey('id', $car);
        self::assertEquals($data['car']['model'], $car['model']);
        self::assertEquals($data['car']['name'], $car['name']);
        self::assertEquals($data['car']['registration_plate'], $car['registration_plate']);

        $user = $carRental['user'];
        self::assertNotNull($user);
        self::assertArrayHasKey('id', $user);
        self::assertEquals($data['user']['name'], $user['name']);
        self::assertEquals($data['user']['email'], $user['email']);
    }

    public function createDataProvider(): Generator
    {
        yield [
            'data' => [
                'car' => [
                    'model' => 'Volkswagen',
                    'name' => 'Golf R',
                    'registration_plate' => 'А888ВВ88'
                ],
                'user' => [
                    'name' => 'Petr Ivanov',
                    'email' => 'ivanov-example@example.com',
                    'password' => 'qwerty'
                ]
            ]
        ];
    }
}
