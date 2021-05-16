<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';

    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = [
        'institution_id'
    ];
}
