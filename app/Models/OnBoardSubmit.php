<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoardSubmit extends Model
{
    use HasFactory;
    protected $table = 'on_board_question_submit';

    protected $fillable = [
        'question_id', 'answer', 'user_id',
    ];
}
