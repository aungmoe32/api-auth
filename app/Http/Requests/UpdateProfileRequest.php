<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd(request('categories'));
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
            'bio' => 'sometimes|string|min:1|max:50',
            'name' => 'sometimes|string|min:1|max:30',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'password' => ['required', 'current_password:sanctum'],
            'categories' => ['sometimes', 'array', 'exists:categories,id']
        ];
    }
}
