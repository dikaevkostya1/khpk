<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    protected $table = 'specialties';

    protected $guarded = [];

    protected $hidden = [
        'institution_id'
    ];

    public function qualifications() {
        return $this->hasMany('App\Qualifications', 'speciality_id', 'id');
    }

}
