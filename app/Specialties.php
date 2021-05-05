<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    protected $table = 'specialties';

    protected $hidden = [
        'institution_id'
    ];

    public function qualifications($finansing_id, $format_id) {
        return $this->hasMany('App\Qualifications', 'speciality_id', 'id')->where('finansing_id', $finansing_id)->where('format_id', $format_id);
    }

}
