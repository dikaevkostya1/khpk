<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'admin_log';

    protected $guarded = [];

    protected $hidden = [
        'institution_id',
        'admin_id'
    ];
}
