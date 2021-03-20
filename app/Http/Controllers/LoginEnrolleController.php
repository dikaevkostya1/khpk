<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginEnrolleController extends Controller
{
    public function index() {
        if (Auth::check()) return redirect()->intended('rating');
        else return view('login');
    }

    public function login(Request $request) {
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'mail' : 'login';
        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            return redirect()->intended('rating');
        }
        else {
            $rule = [
                'message' => 'Неправильный логин (e-mail) или пароль'
            ];
            return redirect()->back()->withInput()->withErrors($rule);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
