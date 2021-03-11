<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Enrolle extends Model
{
    protected $table = 'enrolle';

    protected $guarded = [];

    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'date_born',
        'passport_date'
    ];

    protected $attributes = [
        'email_verified_at' => false
    ];

    protected $hidden = [
        'education_id',
        'institution_id'
    ];
}
