<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user_verify');
    }

    public function index() {
        return view('rating');
    }
}
