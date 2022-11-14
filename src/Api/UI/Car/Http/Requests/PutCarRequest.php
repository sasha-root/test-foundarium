<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Requests;

class PutCarRequest extends PostCarRequest
{
    public function rules(): array
    {
        return [...parent::rules(), ...[
            'car_id' => ['required', 'integer', 'exists:cars,id']
        ]];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['car_id' => $this->route('car_id')]);
    }

    public function getCarId(): int
    {
        return (int)$this->json('car_id');
    }
}
