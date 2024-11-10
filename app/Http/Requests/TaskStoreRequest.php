<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'task_date' => 'required|date',
            'status' => 'required|string',
        ];
    }

    /**
     * Get the custom failure message for the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'description' => 'Please enter a description',
            'task_date' => 'Please select a task date',
            'status' => 'Please select a status',
        ];
    }
}
