<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialties;
use Facade\FlareClient\View;

class HomeController extends Controller
{

    public function __construct()
    {
        $specialties = Specialties::query();
        $specialties->when(request('finansing', 1), function ($q, $filter) {
            return $q->where('finansing_id', $filter);
        });
        $specialties->when(request('format', 1), function ($q, $filter) {
            return $q->where('format_id', $filter);
        });
        $specialties = [
            'specialties' => $specialties->get()
        ];
        $this->specialties = $specialties;
    }

    public function index() {
        return view('home', $this->specialties);
    }

    public function filter() {
        return view('ajax.home.specialties', $this->specialties);
    }

}
