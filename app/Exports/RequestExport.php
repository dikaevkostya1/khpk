<?php

namespace App\Exports;

use App\Requests;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RequestExport implements FromView
{

    public function __construct($institution)
    {
        $this->institution = $institution;
    }

    public function view(): View
    {
        return view('exports.requests', [
            'requests' => Requests::where('institution_id', $this->institution)->get()
        ]);
    }
}
