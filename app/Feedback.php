<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $guarded = [];

    protected $attributes = [
        'answered' => false
    ];

    protected $hidden = [
        'institution_id',
        'answered'
    ];
}
