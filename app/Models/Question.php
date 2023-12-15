<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    use HasFactory;
    protected $fillable = [
        'exam_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'option_f',
        'correct_option',
        'code_snippet',
        'Answer_Explanation',
        'image_file',
        'video_file'
    ];
    public function exam(){

        return $this->belongsTo(Exam::class);
    }
}
