<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:55',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    // Define regex pattern
                    $pattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
                    if (!preg_match($pattern, $value)) {
                        $fail($attribute.' is invalid.');
                    }
                },
            ],
            'role' => 'required|in:admin,project_manager,team_member',
            'password' => 'required|string|min:8',
        ];
    }
    
    /**
     * Customize the error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already taken.',
            'email.custom' => 'The email address format is invalid.', // Custom error message for regex validation
            'role.required' => 'Please select a role.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
