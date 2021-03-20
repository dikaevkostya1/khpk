<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrolleMail;


class CodeSendMailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->middleware('auth');
        $code = random_int(1000, 9999);
        Auth::user()->email_verified_code = $code;
        Auth::user()->save();
        $data = [
            'name' => Auth::user()->full_name,
            'code' => $code
        ];
        Mail::to(Auth::user()->mail)->send(new EnrolleMail($data));
        return back();
    }
}
