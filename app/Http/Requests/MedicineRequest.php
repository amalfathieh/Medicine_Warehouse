<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'scientific_name' => ['required'],
            'commercial_name' => ['required'],
            'company' => ['required'],
            'quantity' => ['required'],
            'date' => ['required'],
            'price' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,bmp,jpg,gif,sav'],
        ];
    }
}
