<?php declare(strict_types=1);

namespace Tests\Api\Application\CarRental\Handlers;

use Api\Application\CarRental\Command\Commands\DeleteCarRentalCommand;
use Api\Application\CarRental\Command\Handlers\DeleteCarRentalHandler;
use Api\Domain\CarRental\Exception\CarRentalNotFoundException;
use Tests\TestCase;
use Generator;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\Application\CarRental\Command\Commands\CreateCarRentalCommand;
use Api\Application\CarRental\Command\Handlers\CreateCarRentalHandler;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Api\Domain\Car\Model\Car;
use Api\Domain\CarRental\Model\CarRental;
use Api\Domain\User\Model\User;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\UI\CarRental\Http\Requests\PostCarRentalRequest;
use Api\UI\User\Http\Requests\PostUserRequest;
use Illuminate\Support\Facades\DB;

class DeleteCarRentalTest extends TestCase
{
    /**
     * @param array $data
     * @throws CarRentalNotFoundException
     * @dataProvider deleteDataProvider
     */
    public function testDelete(array $data)
    {
        /** @var CarRental|null $carRental */
        if ($carRental = CarRental::first()) {
            $id = $carRental->id;
        } else {
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
            $id = (int)$carRental['id'];
        }

        $deleteCarRentalCommand = new DeleteCarRentalCommand($id);

        /** @var DeleteCarRentalHandler $deleteCarRentalHandler */
        $deleteCarRentalHandler = $this->app->make(DeleteCarRentalHandler::class);
        $deleteCarRentalHandler->handle($deleteCarRentalCommand);

        $result = CarRental::query()->where(['id' => $id])->first();
        $this->assertNull($result);
    }

    public function deleteDataProvider(): Generator
    {
        yield [
            'data' => [
                'car' => [
                    'model' => 'Volkswagen',
                    'name' => 'Golf R',
                    'registration_plate' => 'В888ВВ88'
                ],
                'user' => [
                    'name' => 'Petr Ivanov',
                    'email' => 'example@example.com',
                    'password' => 'qwerty'
                ]
            ]
        ];
    }
}
