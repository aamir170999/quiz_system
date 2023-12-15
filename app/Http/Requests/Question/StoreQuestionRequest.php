<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_id' => 'required|exists:exams,id',
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
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'video_file' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if options are unique
            $options = collect([
                $this->input('option_a'),
                $this->input('option_b'),
                $this->input('option_c'),
                $this->input('option_d'),
                $this->input('option_e'),
                $this->input('option_f'),
            ])->filter();

            if ($options->count() !== $options->unique()->count()) {
                $validator->errors()->add('option', 'Options must be unique.');
            }

            // Check file extension if image_file is provided
            // $imageFile = $this->file('image_file');

            // if ($imageFile && method_exists($imageFile, 'extension')) {
            //     $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];

            //     if (!in_array($imageFile->extension(), $allowedExtensions)) {
            //         $validator->errors()->add('image_file', 'Invalid image file format.');
            //     }
            // }
        });
    }
}
