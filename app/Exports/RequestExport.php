<?php

namespace App\Exports;

use App\Requests;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RequestExport implements FromView
{

    public function __construct($institution, $specialty)
    {
        $this->institution = $institution;
        $this->specialty = $specialty;
    }

    public function view(): View
    {
        return view('exports.requests', [
            'requests' => Requests::where('institution_id', $this->institution)->where('speciality_id', $this->specialty)->get()
        ]);
    }
}
