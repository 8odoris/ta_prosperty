<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexSpyRequest extends FormRequest
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
            '*' => ['in:orderBy,age,full_name'],
            'orderBy' => ['sometimes', 'array:full_name,birth_date,death_date'],
            'orderBy.*' => ['string', 'in:asc,desc'],
            'age' => ['sometimes', 'array', 'required_array_keys:min,max'],
            'age.min' => ['integer', 'min:0'],
            'age.max' => ['integer', 'gte:age.min'],
            'full_name' => ['sometimes', 'string', 'nullable'],
        ];
    }
}
