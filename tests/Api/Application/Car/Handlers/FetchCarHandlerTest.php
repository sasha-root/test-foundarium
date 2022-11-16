<?php declare(strict_types=1);

namespace Tests\Api\Application\Car\Handlers;

use Tests\TestCase;
use Generator;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\Application\Car\Query\Queries\FetchCarQuery;
use Api\Application\Car\Query\Handlers\FetchCarHandler;
use Api\Domain\Car\Exception\CarNotFoundException;

class FetchCarHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider fetchDataProvider
     * @throws CarNotFoundException
     */
    public function testFetch(array $data): void
    {
        $postCarRequest = new PostCarRequest();
        $postCarRequest->json()->add($data);

        $commandCarCreate = new CreateCarCommand($postCarRequest);

        /** @var CreateCarHandler $createCarHandler */
        $createCarHandler = $this->app->make(CreateCarHandler::class);
        $carCreate = $createCarHandler->handle($commandCarCreate)->resolve();
        $id = (int)$carCreate['id'];

        $fetchCarQuery = new FetchCarQuery($id);
        /** @var FetchCarHandler $fetchCarHandler */
        $fetchCarHandler = $this->app->make(FetchCarHandler::class);
        $car = $fetchCarHandler->handle($fetchCarQuery)->resolve();

        self::assertNotNull($car);
        self::assertArrayHasKey('id', $car);
        self::assertEquals($data['model'], $car['model']);
        self::assertEquals($data['name'], $car['name']);
        self::assertEquals($data['registration_plate'], $car['registration_plate']);
    }

    public function fetchDataProvider(): Generator
    {
        yield [
            'data' => [
                'model' => 'Volkswagen',
                'name' => 'Golf TSI 1.4',
                'registration_plate' => 'Н888НН88'
            ]
        ];
    }
}
