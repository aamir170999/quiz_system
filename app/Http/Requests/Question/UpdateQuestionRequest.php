<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
        // $examId = $this->route('question')->exam_id;

        return [
            'question' => 'required|max:255|min:5',
            'option_a' => 'required|max:150',
            'option_b' => 'required|max:150',
            'option_c' => 'required|max:150',
            'option_d' => 'required|max:150',
            'option_e' => 'nullable|max:150',
            'option_f' => 'nullable|max:150',
            'correct_option' => 'required|in:a,b,c,d,e,f',
            'code_snippet' => 'nullable',
            'Answer_Explanation' => 'nullable',
            'image_file' => 'nullable',
            'video_file' => 'nullable',
        ];
    }
}
