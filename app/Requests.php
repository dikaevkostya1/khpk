<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{

    protected $table = 'requests';

    protected $guarded = [];

    protected $attributes = [
        'status_id' => 1
    ];

    protected $hidden = [
        'enrolle_id',
        'speciality_id',
        'status_id',
        'remember_token',
    ];

    public function speciality()
    {
        return $this->belongsTo('App\Specialties','speciality_id','id');
    }

    public function status()
    {
        return $this->belongsTo('App\StatusesRequest','status_id','code');
    }
}
