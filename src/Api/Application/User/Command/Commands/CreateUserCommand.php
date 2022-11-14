<?php declare(strict_types=1);

namespace Api\Application\User\Command\Commands;

use Api\UI\User\Http\Requests\PostUserRequest;

class CreateUserCommand extends CreateUpdateUserCommand
{
    private string $password;

    public function __construct(PostUserRequest $request)
    {
        $this->password = $request->getPassword();
        parent::__construct($request);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
