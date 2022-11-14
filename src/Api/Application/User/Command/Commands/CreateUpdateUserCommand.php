<?php declare(strict_types=1);

namespace Api\Application\User\Command\Commands;

use Api\UI\User\Http\Requests\PostUserRequest;
use Api\UI\User\Http\Requests\PutUserRequest;

class CreateUpdateUserCommand
{
    private string $name;

    private string $email;

    public function __construct(PostUserRequest|PutUserRequest $request)
    {
        $this->name = $request->getName();
        $this->email = $request->getEmail();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
