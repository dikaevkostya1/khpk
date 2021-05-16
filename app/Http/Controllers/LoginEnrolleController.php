<?php

namespace App\Http\Controllers;

use App\Mail\EnrolleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginEnrolleController extends Controller
{
    public function index() {
        if (Auth::check()) return redirect()->intended('rating');
        else return view('login');
    }

    public function login(Request $request) {
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'mail' : 'login';
        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            $enrolle = Auth::user();
            if ($enrolle->email_verified == false) {
                $enrolle->email_verified_code = random_int(1000, 9999);
                $enrolle->save();
                $data = [
                    'name' => $enrolle->full_name,
                    'code' => $enrolle->email_verified_code
                ];
                Mail::to($enrolle->mail)->send(new EnrolleMail($data));
            }
            return redirect()->intended('rating');
        }
        else {
            $rule = [
                'message' => 'Неправильный логин (email) или пароль'
            ];
            return redirect()->back()->withInput()->withErrors($rule);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
