<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:155|unique:projects,name',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'description' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            'status' => 'required',
        ];
        if (auth()->user()->role == 'admin') {
            $rules['project_manager_id'] = 'required|exists:users,id';
        } else {
            $rules['project_manager_id'] = 'sometimes|nullable|exists:users,id';
        }
        return $rules;
    
    }

    /**
     * Get custom validation messages for attributes.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project_manager_id.sometimes' => 'The project Manager field is required.',
            'user_ids.required' => 'The Members field is required.',
            'user_ids.*.exists' => 'Selected member does not exist.',
            'end_date.after_or_equal' => 'End date must be a date after or equal to the start date.',
        ];
    }
}
