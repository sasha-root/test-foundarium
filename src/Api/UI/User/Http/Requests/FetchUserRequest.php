<?php declare(strict_types=1);

namespace Api\UI\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getUserId(): int
    {
        return (int)$this->route('user_id');
    }
}
