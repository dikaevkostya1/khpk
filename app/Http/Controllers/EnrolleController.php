<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrolle;
use App\Educations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrolleMail;
use Throwable;
use Illuminate\Support\Facades\Auth;

class EnrolleController extends Controller
{
    public function index(Request $request) {
        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'educations' => Educations::all()
        ];
        return view('enrolle', $data);
    }

    public function enrolle(Request $request) {
        $messages = [
            'login.unique' => 'Такой логин уже занят',     
            'mail.unique' => 'Эта почта уже используется'
        ];
        $validator = Validator::make($request->all(), [
            'login' => 'unique:enrolle',
            'mail' => 'unique:enrolle'
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        else {
            $enrolle = Enrolle::create([
                'full_name' => $request->surname.' '.$request->name.' '.$request->middlename,
                'address_actual' => $request->address_actual,
                'address_registration' => $request->address_registration,
                'phone' => $request->phone,
                'date_born' => $request->date_born,
                'place_born' => $request->place_born,
                'passport_series' => $request->passport_series,
                'passport_number' => $request->passport_number,
                'passport_date' => $request->passport_date,
                'passport_issued' => $request->passport_issued,
                'education_id' => $request->education,
                'education_ending' => $request->education_ending,
                'education_name' => $request->education_name,
                'education_series' => $request->education_series,
                'education_number' => $request->education_number,
                'login' => $request->login,
                'mail' => $request->mail,
                'password' => Hash::make($request->password),
                'remember_token' => Hash::make(Str::random(5)),
                'email_verified_code' => random_int(1000, 9999)
            ]);
            try {
                $enrolle->save();
                $data = [
                    'name' => $enrolle->full_name,
                    'code' => $enrolle->email_verified_code
                ];
                Mail::to($enrolle->mail)->send(new EnrolleMail($data));
                if (Auth::guard('admin')->attempt($credentials)) {
                    //
                }
                return response()->json([
                    'view' => view('email_verified')->render()
                ], 200);
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => [0 => 'Произошла ошибка на сервере: '.$e]
                ], 500);
            }
        }
    }

    public function email_verified_show() {
        return view('emails.enrolle');
    }

    public function email_verified(Request $request) {
        return redirect()->route('request');
    }
}
