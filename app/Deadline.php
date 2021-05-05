<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $table = 'admission_deadline';

    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = [
        'institution_id',
        'format_id'
    ];
}
