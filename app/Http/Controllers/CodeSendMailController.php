<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrolleMail;
use Carbon\Carbon;

class CodeSendMailController extends Controller
{
    public function __invoke()
    {
        if (Carbon::parse(Auth::user()->updated_at) < Carbon::parse('-1 minutes')) {
            $this->middleware('auth');
            $code = random_int(1000, 9999);
            Auth::user()->email_verified_code = $code;
            Auth::user()->save();
            $data = [
                'name' => Auth::user()->full_name,
                'code' => $code
            ];
            Mail::to(Auth::user()->mail)->send(new EnrolleMail($data));
        }
        return response()->json(200);
    }
}
