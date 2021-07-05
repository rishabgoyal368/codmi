<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CommonTrait;

class OnBoardSubmit extends Model
{
    use HasFactory;
    use CommonTrait;
    protected $table = 'on_board_question_submit';

    protected $fillable = [
        'question_id', 'answer', 'user_id',
    ];

    public function getQuestionIdAttribute($value)
    {
        $questions = $this->onBoardingQuestion();
        foreach ($questions as $key => $question) {
            if($question['id'] == $value)
            {
                return $question['question'];
            }
        }
        return '-';
    }
}
