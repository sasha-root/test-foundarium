<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getCarId(): int
    {
        return (int)$this->route('car_id');
    }
}
