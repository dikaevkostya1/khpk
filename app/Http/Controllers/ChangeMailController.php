<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangeMailController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->middleware('auth');
        $messages = [   
            'mail.unique' => 'Эта почта уже используется',
            'mail.required' => 'Заполните поле',
            'mail.email' => 'Некорректный Email'
        ];
        $rules = [
            'mail' => 'unique:enrolle|required|email'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->all());
        }
        else {
            Auth::user()->mail = $request->mail;
            Auth::user()->save();
            return redirect()->route('request');
        }
    }
}
