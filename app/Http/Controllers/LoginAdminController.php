<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index() {
        if (Auth::guard('admin')->check()) return redirect()->intended('admin');
        else return view('admin.login');
    }

    public function login(Request $request) {
        if (Auth::guard('admin')->attempt(['login' => $request->login, 'password' => $request->password])) {
            return redirect()->intended('admin');
        }
        else {
            $rule = [
                'message' => 'Неправильный логин или пароль'
            ];
            return redirect()->back()->withInput()->withErrors($rule);
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin');
    }
}
