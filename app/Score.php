<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    
    protected $table = 'score';

    protected $fillable = [
        'quote_id',
        'wpm',
        'acc',
        'user_id'
    ];

}
