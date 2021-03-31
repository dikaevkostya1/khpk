<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $table = 'admin_users';

    protected $guarded = [];

    protected $attributes = [
        'email_verified' => false
    ];

    protected $hidden = [
        'password',
        'institution_id',
        'remember_token',
    ];
}
