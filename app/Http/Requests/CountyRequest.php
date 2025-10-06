<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountyRequest extends FormRequest
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
                "name" => "required|string|min:1|max:25"
            ];
        }
        return [
            "name" => "string|min:1|max:25"
        ];
    }
}
