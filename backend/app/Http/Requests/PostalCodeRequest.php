<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostalCodeRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                "postal_code" => "required|integer",
                "city_id" => "required|integer|exists:cities,id"
            ];
        }

        return [
            "postal_code" => "integer",
            "city_id" => "integer|exists:cities,id"
        ];
    }
}
