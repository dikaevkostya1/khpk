<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualifications extends Model
{
    protected $table = 'specialties_qualifications';

    protected $guarded = [];

    public function speciality()
    {
        return $this->belongsTo('App\Specialties','speciality_id','id');
    }

}
