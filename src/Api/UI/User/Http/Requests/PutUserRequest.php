<?php declare(strict_types=1);

namespace Api\UI\User\Http\Requests;

class PutUserRequest extends PostUserRequest
{
    public function rules(): array
    {
        $parentRules = parent::rules();
        unset(
            $parentRules['email'],
            $parentRules['password']
        );

        return [...$parentRules, ...[
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'email' => ['required', 'string', 'unique:users', 'max:100']
        ]];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['user_id' => $this->route('user_id')]);
    }

    public function getUserId(): int
    {
        return (int)$this->json('user_id');
    }
}
