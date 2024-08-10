<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => ['required', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 10) {
                    $fail('The ' . $attribute . ' may not be greater than 10 words.');
                }
            }],
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'week_start' => 'required|date',
            'category' => 'required|string|in:Breakfast,Lunch,Dinner'
        ];
    }
}
