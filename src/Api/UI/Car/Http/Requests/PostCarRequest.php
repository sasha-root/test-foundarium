<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCarRequest extends FormRequest
{
    // @todo registration_plate regex - только для частных транспортных средств
    public function rules(): array
    {
        return [
            'model' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'registration_plate' => ['required', 'string', 'max:9', 'regex:/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui']
        ];
    }

    public function getModel(): string
    {
        return $this->json('model');
    }

    public function getName(): string
    {
        return $this->json('name');
    }

    public function getRegistrationPlate(): string
    {
        return $this->json('registration_plate');
    }
}
