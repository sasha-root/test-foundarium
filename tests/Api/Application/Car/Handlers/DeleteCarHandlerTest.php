<?php declare(strict_types=1);

namespace Tests\Api\Application\Car\Handlers;

use Tests\TestCase;
use Generator;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\Application\Car\Command\Commands\DeleteCarCommand;
use Api\Application\Car\Command\Handlers\DeleteCarHandler;
use Api\Domain\Car\Model\Car;
use Api\Domain\CarRental\Model\CarRental;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\Domain\Car\Exception\CarNotAvailableDeleteException;
use Api\Domain\Car\Exception\CarNotFoundException;

class DeleteCarHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider deleteDataProvider
     * @throws CarNotFoundException|CarNotAvailableDeleteException
     */
    public function testDelete(array $data): void
    {
        CarRental::truncate();

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

        $deleteCarCommand = new DeleteCarCommand($id);

        /** @var DeleteCarHandler $deleteCarHandler */
        $deleteCarHandler = $this->app->make(DeleteCarHandler::class);
        $deleteCarHandler->handle($deleteCarCommand);

        $result = Car::query()->where(['id' => $id])->first();
        $this->assertNull($result);
    }

    public function deleteDataProvider(): Generator
    {
        yield [
            'data' => [
                'model' => 'Volkswagen',
                'name' => 'Golf R',
                'registration_plate' => 'В888ВВ88'
            ]
        ];
    }
}

