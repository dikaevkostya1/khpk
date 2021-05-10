<?php
namespace App\Helpers;

use App\Specialties;

class SpecialtiesHelpers
{

    public static function get() {
        return Specialties::where('institution_id', request('institution', 1))->whereHas('qualifications', $filter = function($query) {
            $query->where('format_id', request('format', 1));
            $query->where('finansing_id', request('finansing', 1));
        })->with(['qualifications' => $filter])->get();
    }
}