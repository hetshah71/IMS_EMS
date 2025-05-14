<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternsRequest extends FormRequest
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
            // 'intern_id' => 'required|exists:interns,id',
            // 'task_id' => 'required|exists:tasks,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'department' => 'required|string|max:255',
        ];
    }
}
