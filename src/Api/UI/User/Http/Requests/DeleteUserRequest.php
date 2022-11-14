<?php declare(strict_types=1);

namespace Api\UI\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id']
        ];
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
