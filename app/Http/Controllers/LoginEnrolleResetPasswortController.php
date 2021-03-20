<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\EnrolleResetPasswordMail;
use App\Enrolle;
use Carbon\Carbon;

class LoginEnrolleResetPasswortController extends Controller
{
    public function push(Request $request) {
        $enrolle = Enrolle::where('mail', $request->mail)->first();
        if ($enrolle) {
            $enrolle->remember_token = Hash::make(Str::random(5));
            $enrolle->save();
            $data = [
                'name' => $enrolle->full_name,
                'link' => route('reset_password',[
                    'token' => $enrolle->remember_token
                ])
            ];
            Mail::to($request->mail)->send(new EnrolleResetPasswordMail($data));
            return view('reset_password_token', [
                'message' => 'На вашу почту отправлено письмо для восстановления'
            ]);
        }
        return view('reset_password_token', [
            'message' => 'Почта не найдена'
        ]);
    }

    public function auth(Request $request) {
        $enrolle = $this->validToken($request->token);
        if ($enrolle) return view('reset_password');
        else return redirect()->route('home');
    }

    public function reset(Request $request) {
        $enrolle = $this->validToken($request->token);
        if ($enrolle) {
            $enrolle->password = Hash::make($request->password);
            $enrolle->save();
            return redirect()->route('login');
        }
        else return redirect()->route('home');
    }

    private function validToken($token) {
        return Enrolle::where('remember_token', $token)
        ->where('created_at', '>', Carbon::parse('-10 minutes'))
        ->first();
    }
}
