<?php declare(strict_types=1);

namespace Tests\Api\Application\Car\Handlers;

use Tests\TestCase;
use Generator;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;

class CreateCarHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @dataProvider createDataProvider
     */
    public function testCreate(array $data): void
    {
        $request = new PostCarRequest();
        $request->json()->add($data);

        $command = new CreateCarCommand($request);

        /** @var CreateCarHandler $handler */
        $handler = $this->app->make(CreateCarHandler::class);
        $car = $handler->handle($command)->resolve();

        self::assertNotNull($car);
        self::assertArrayHasKey('id', $car);
        self::assertEquals($data['model'], $car['model']);
        self::assertEquals($data['name'], $car['name']);
        self::assertEquals($data['registration_plate'], $car['registration_plate']);
    }

    public function createDataProvider(): Generator
    {
        yield [
            'data' => [
                'model' => 'Volkswagen',
                'name' => 'Golf R',
                'registration_plate' => 'В999ВВ99'
            ]
        ];
    }
}
