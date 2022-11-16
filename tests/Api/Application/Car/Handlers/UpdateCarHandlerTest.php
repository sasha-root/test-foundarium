<?php declare(strict_types=1);

namespace Tests\Api\Application\Car\Handlers;

use Tests\TestCase;
use Generator;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Commands\UpdateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\Application\Car\Command\Handlers\UpdateCarHandler;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Domain\Car\Model\Car;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\UI\Car\Http\Requests\PutCarRequest;

class UpdateCarHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @dataProvider updateDataProvider
     * @throws CarNotFoundException
     */
    public function testUpdate(array $data): void
    {
        /** @var Car|null $car */
        if ($car = Car::first()) {
            $id = $car->id;
        } else {
            $postCarRequest = new PostCarRequest();
            $postCarRequest->json()->add($data);

            $commandCarCreate = new CreateCarCommand($postCarRequest);

            /** @var CreateCarHandler $createCarHandler */
            $createCarHandler = $this->app->make(CreateCarHandler::class);
            $car = $createCarHandler->handle($commandCarCreate)->resolve();
            $id = $car['id'];
        }

        $putCarRequest = new PutCarRequest();
        $putCarRequest->json()->add([...$data, ...['car_id' => (int)$id]]);

        $commandUpdate = new UpdateCarCommand($putCarRequest);

        /** @var UpdateCarHandler $updateCarHandler */
        $updateCarHandler = $this->app->make(UpdateCarHandler::class);
        $updateCar = $updateCarHandler->handle($commandUpdate)->resolve();

        self::assertNotNull($updateCar);
        self::assertArrayHasKey('id', $updateCar);

        /** @var Car $carModel */
        $carModel = Car::query()->where(['id' => $updateCar['id']])->first();

        self::assertEquals($data['model'], $carModel->model);
        self::assertEquals($data['name'], $carModel->name);
        self::assertEquals($data['registration_plate'], $carModel->registration_plate);
    }

    public function updateDataProvider(): Generator
    {
        yield [
            'data' => [
                'model' => 'Volkswagen',
                'name' => 'Golf TSI',
                'registration_plate' => 'A888AA88'
            ]
        ];
    }
}
