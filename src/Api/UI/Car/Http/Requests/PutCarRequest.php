<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Requests;

class PutCarRequest extends PostCarRequest
{
    public function rules(): array
    {
        $parentRules = parent::rules();
        unset($parentRules['registration_plate']);

        return [...$parentRules, ...[
            'car_id' => ['required', 'integer', 'exists:cars,id'],
            'registration_plate' => [
                'required',
                'string',
                'max:9',
                'regex:/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui',
                'unique:cars,registration_plate,' . $this->json('car_id')
            ]
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
