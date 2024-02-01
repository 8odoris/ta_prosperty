<?php

namespace App\Http\Requests;

use App\Enums\AgenciesEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreSpyRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:255', Rule::unique('spies')
                ->where(fn(Builder $query) => $query->where(['surname' => $this->surname, 'birth_date' => $this->birth_date]))],
            'surname' => ['required', 'string', 'max:255'],
            'agency' => ['nullable', new Enum(AgenciesEnum::class)],
            'country_of_operation' => ['string', 'max:255'],
            'birth_date' => ['bail', 'required', 'date', 'before:today'],
            'death_date' => ['nullable', 'date', 'after:birth_date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'The spy must be unique.',
        ];
    }
}
