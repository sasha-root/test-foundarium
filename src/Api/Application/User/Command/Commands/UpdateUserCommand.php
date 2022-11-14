<?php declare(strict_types=1);

namespace Api\Application\User\Command\Commands;

use Api\UI\User\Http\Requests\PutUserRequest;

class UpdateUserCommand extends CreateUpdateUserCommand
{
    private int $id;

    public function __construct(PutUserRequest $request, int $id)
    {
        $this->id = $id;
        parent::__construct($request);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
