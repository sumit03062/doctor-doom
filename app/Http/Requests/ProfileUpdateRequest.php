<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
                // Optional: add regex for phone format if you want
                // 'regex:/^[\+]?[0-9\s\-\(\)]+$/',
            ],

            'age' => [
                'nullable',
                'integer',
                'min:1',
                'max:120',
            ],

            'gender' => [
                'nullable',
                'in:male,female,other',
            ],
        ];
    }

    /**
     * Custom error messages for better UX
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your full name.',
            'email.required'   => 'Email address is required.',
            'email.email'      => 'Please enter a valid email address.',
            'email.unique'     => 'This email is already taken.',
            'phone.max'        => 'Phone number cannot be longer than 20 characters.',
            'age.integer'      => 'Age must be a number.',
            'age.min'          => 'Age must be at least 1.',
            'age.max'          => 'Age cannot be more than 120.',
            'gender.in'        => 'Please select a valid gender option.',
        ];
    }
}