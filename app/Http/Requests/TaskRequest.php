<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure this is set correctly according to your application's needs
    }

    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required',
            'description' => 'required|string',
            'status' => 'required|in:pending,complete',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'The project field is required.',
            'project_id.exists' => 'The selected project does not exist.',
            'user_id.required' => 'Please select at least one member.',
            'description.required' => 'The description field is required.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'start_date.required' => 'The start date is required.',
            'end_date.after_or_equal' => 'The end date cannot be earlier than the start date.',
        ];
    }
}
