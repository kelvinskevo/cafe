<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChefRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'google_plus' => 'nullable|url',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'role.required' => 'Role is required.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Only jpeg, png, jpg, and gif files are allowed.',
            'image.max' => 'Image size should not exceed 2MB.',
            'facebook.url' => 'Please enter a valid Facebook URL.',
            'twitter.url' => 'Please enter a valid Twitter URL.',
            'google_plus.url' => 'Please enter a valid Google Plus URL.',
        ];
    }
}
