<?php declare(strict_types=1);

namespace Api\UI\CarRental\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCarRentalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'car_id' => [
                'required',
                'integer',
                'exists:cars,id',
                'unique:cars_rental,car_id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                'unique:cars_rental,user_id'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'The user is already driving the car',
            'car_id.unique' => 'The car is already taken',
        ];
    }

    public function getCarId(): int
    {
        return (int)$this->json('car_id');
    }

    public function getUserId(): int
    {
        return (int)$this->json('user_id');
    }
}
