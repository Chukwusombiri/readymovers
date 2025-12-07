<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateDeliveryItems extends FormRequest
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
            'items' => 'required|array|min:1',
            'items.*' => 'required|array',
            'items.*.id' => 'required|integer|exists:items,id',
            'items.*.name' => ['required','string',function ($attribute, $value, $fail){
               // Extract index from "items.X.name"
               $index = str_replace(['items.', '.name'], '', $attribute);
               $id = data_get($this->input('items'), "$index.id");
                if (!DB::table('items')->where('id', $id)->where('name', $value)->exists()) {
                    $fail("The selected name does not match the given ID.");
                }
            }],
            'items.*.qty' => 'nullable|integer|min:1'
        ];
    }
}
