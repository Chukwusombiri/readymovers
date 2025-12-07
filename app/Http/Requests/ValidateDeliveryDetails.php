<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDeliveryDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {       
        return [
            'pickUpAddress' => ['required', 'string'],
            'pickUpFloor' => ['required', 'string', 'exists:floors,name'],
            'pickUpPostCode' => ['required', 'regex:/^[A-Za-z0-9\- ]+$/'],
            'deliveryAddress' => ['required', 'string'],
            'deliveryFloor' => ['required', 'string', 'exists:floors,name'],
            'deliveryPostCode' => ['required', 'regex:/^[A-Za-z0-9\- ]+$/'],
            'pickUpDate' => ['required', 'date', 'after_or_equal:today'],
            'elevatorIsAvailableAtPickUp' => ['boolean'],
            'elevatorIsAvailableAtDelivery' => ['boolean'],
            'packingAtPickUp' => ['boolean'],
            'unpackingAtDelivery' => ['boolean'],
        ];
    }


    public function attributes()
    {
        return [
            'pickUpAddress' => 'Pick-up address',
            'pickUpFloor' => 'Pick-up floor',
            'pickUpPostCode' => 'Pick-up postal code',
            'deliveryAddress' => 'Delivery address',
            'deliveryFloor' => 'Delivery floor',
            'deliveryPostCode' => 'Delivery postal code',
            'pickUpDate' => 'Pick-up date',
            'elevatorIsAvailableAtPickUp' => 'Pick-up Elevator',
            'packingAtPickUp' => 'Packing at pick-up',
            'unpackingAtDelivery' => 'unpacking at delivery',
            'elevatorIsAvailableAtDelivery' => 'Delivery Elevator',
        ];
    }
}
