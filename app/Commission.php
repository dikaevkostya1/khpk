<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';

    protected $guarded = [];

    protected $hidden = [
        'institution_id'
    ];
}
