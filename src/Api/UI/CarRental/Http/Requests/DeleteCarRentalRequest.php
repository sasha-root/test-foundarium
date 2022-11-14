<?php declare(strict_types=1);

namespace Api\UI\CarRental\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCarRentalRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getCarRentalId(): int
    {
        return (int)$this->route('car_rental_id');
    }
}

