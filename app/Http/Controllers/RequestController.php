<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(Request $request) {
        $data = [
            'name' => $request->name,
            'surname' => $request->surname
        ];
        return view('request', $data);
    }
}
