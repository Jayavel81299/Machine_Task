<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
        $projectId = $this->route('project'); 
        return [
            'name' => 'required|string|max:155|unique:projects,name,' . $projectId->id,
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'description' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            'status' => 'required',
        ];
    }

    /**
     * Get custom validation messages for attributes.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_ids.required' => 'The Members field is required.',
            'user_ids.*.exists' => 'Selected member does not exist.',
            'end_date.after_or_equal' => 'End date must be a date after or equal to the start date.',
        ];
    }
}
