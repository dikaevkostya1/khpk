<?php

namespace App\Http\Controllers;

use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user_verify');
    }

    public function index() {
        $id = Auth::user()->id;
        $requests = Requests::where('enrolle_id', $id)->where('institution_id', request('institution', 1))->get();
        return view('rating', [
            'enrolle' => Auth::user(),
            'requests' => $requests
        ]);
    }

    public function request_delete($id) {
        Requests::destroy($id);
        return redirect()->route('rating');
    }
}
