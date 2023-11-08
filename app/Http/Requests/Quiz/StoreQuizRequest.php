<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'max:500',
            'time' => 'required|numeric|integer',
            'total_marks' => 'required|numeric|integer|',
            'difficulty' => 'required|numeric|integer|max:10|min:1',
            'marks_per_question' => 'required|numeric|gte:1',
            'exam_fees' => 'required_if:is_paid,==,yes',
            'show_answer' => 'in:yes,no'
        ];
    }
}
