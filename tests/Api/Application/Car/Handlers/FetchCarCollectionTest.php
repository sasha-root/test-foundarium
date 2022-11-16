<?php declare(strict_types=1);

namespace Tests\Api\Application\Car\Handlers;

use Api\Domain\CarRental\Model\CarRental;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Generator;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\Domain\Car\Model\Car;

class FetchCarCollectionTest extends TestCase
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
        Car::truncate();
        DB::statement("SET foreign_key_checks=1");

        /** @var CreateCarHandler $createCarHandler */
        $createCarHandler = $this->app->make(CreateCarHandler::class);

        foreach ($dataItems as $data) {
            $request = new PostCarRequest();
            $request->json()->add($data);

            $command = new CreateCarCommand($request);

            $car = $createCarHandler->handle($command)->resolve();

            self::assertNotNull($car);
            self::assertArrayHasKey('id', $car);
            self::assertEquals($data['model'], $car['model']);
            self::assertEquals($data['name'], $car['name']);
            self::assertEquals($data['registration_plate'], $car['registration_plate']);
        }
    }

    public function fetchDataProvider(): Generator
    {
        yield [
            'dataItems' => [
                [
                    'model' => 'Volkswagen',
                    'name' => 'Golf TSI 1.4',
                    'registration_plate' => 'Н777НН77'
                ],
                [
                    'model' => 'Volkswagen',
                    'name' => 'Golf GTI',
                    'registration_plate' => 'А001АА138'
                ],
                [
                    'model' => 'Volkswagen',
                    'name' => 'Golf R',
                    'registration_plate' => 'В888ВВ88'
                ]
            ]
        ];
    }
}
