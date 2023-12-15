<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;
  
    protected $fillable = [
        'title',
        'description',
        'time',
        'total_marks',
        'marks_per_question',
        'difficulty',
        'exam_fees',
        'show_answer'
    ];
    public function questions(){
        return $this->hasMany(Question::class);

     }
}
