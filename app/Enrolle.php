<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Enrolle extends Authenticatable
{

    use Notifiable;

    protected $guard = 'users';

    protected $table = 'enrolle';

    protected $guarded = [];

    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'date_born',
        'passport_date'
    ];

    protected $attributes = [
        'email_verified' => false
    ];

    protected $hidden = [
        'password',
        'education_id',
        'institution_id',
        'remember_token',
    ];
}
