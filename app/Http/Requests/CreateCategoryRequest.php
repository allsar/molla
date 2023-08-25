<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' =>['integer'],
            'name' => ['string', 'required', 'max:255'],
            'slug' => ['string', 'max:255'],
            'parent_id' => ['required_if:method,1', 'integer'],
            'method' => ['integer'],
            'description' => ['string']
        ];
    }
}
