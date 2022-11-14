<?php declare(strict_types=1);

namespace Api\UI\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'unique:users', 'max:100'],
            'password' => ['required', 'string', 'min:6']
        ];
    }

    public function getName(): string
    {
        return $this->json('name');
    }

    public function getEmail(): string
    {
        return $this->json('email');
    }

    public function getPassword(): string
    {
        return $this->json('password');
    }
}
