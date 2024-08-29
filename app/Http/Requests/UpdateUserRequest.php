<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $userId = $this->route('user'); 

        return [
            'name' => 'required|string|min:2|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
                function ($attribute, $value, $fail) {
                    // Define regex pattern
                    $pattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
                    if (!preg_match($pattern, $value)) {
                        $fail('The email address format is invalid.');
                    }
                },
            ],
            'role' => 'required|in:admin,project_manager,team_member',
            'password' => 'nullable|string|min:8', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already taken.',
            'role.required' => 'Please select a role.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
