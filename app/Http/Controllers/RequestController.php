<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Educations;
use App\Requests;
use App\Specialties;
use App\Institutions;
use App\Enrolle;
use App\Mail\EnrolleMail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    public function __construct(Request $request) {
        $specialties = Specialties::query();
        $specialties->when(request('institution', 1), function ($q, $filter) {
            return $q->where('institution_id', $filter);
        });
        $this->specialties = $specialties->get();
    }

    public function index(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->email_verified == true) {
                $data = [
                    'specialties' => $this->specialties,
                    'institutions' => Institutions::all(), 
                    'request_stage' => 3
                ];
            }
            else $data = [
                'request_stage' => 2
            ];
        }
        else {
            $data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'mail' => $request->mail,
                'educations' => Educations::all(),
                'request_stage' => 1
            ];
        }
        return view('request', $data);
    }

    public function push(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->email_verified == true) return $this->request($request);
            else return $this->email_verified($request);
        }
        else return $this->enrolle($request);
    }

    private function enrolle(Request $request) {
        $messages = [
            'login.unique' => 'Такой логин уже занят',     
            'mail.unique' => 'Эта почта уже используется',
            'passport.unique' => 'Такие паспортные данные уже используются. Скорее всего вы уже зарегистрированы, <a href="/login">войдите</a> в свой личный кабинет'
        ];
        $rules = [
            'login' => 'unique:enrolle',
            'mail' => 'unique:enrolle|email',
            'passport' => 'unique:enrolle'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        else {
            try {
                $enrolle = Enrolle::create([
                    'full_name' => $request->surname.' '.$request->name.' '.$request->middlename,
                    'address_actual' => $request->address_actual,
                    'address_registration' => $request->address_registration,
                    'phone' => $request->phone,
                    'date_born' => Carbon::parse($request->date_born)->format('Y-m-d'),
                    'place_born' => $request->place_born,
                    'passport' => $request->passport,
                    'passport_date' => Carbon::parse($request->passport_date)->format('Y-m-d'),
                    'passport_issued' => $request->passport_issued,
                    'education_id' => $request->education_id,
                    'education_ending' => $request->education_ending,
                    'education_name' => $request->education_name,
                    'education' => $request->education,
                    'login' => $request->login,
                    'mail' => $request->mail,
                    'password' => Hash::make($request->password),
                    'remember_token' => Hash::make(Str::random(5)),
                    'email_verified_code' => random_int(1000, 9999)
                ]);
                $enrolle->save();
                $data = [
                    'name' => $enrolle->full_name,
                    'code' => $enrolle->email_verified_code
                ];
                // Mail::to($enrolle->mail)->send(new EnrolleMail($data));
                if (Auth::loginUsingId($enrolle->id)) {
                    return response()->json([
                        'view' => view('ajax.request.verified')->render()
                    ], 200);
                }
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => ['Произошла ошибка на сервере'.$e]
                ], 500);
            }
        }
    }

    private function email_verified(Request $request) {
        try {
            if (Auth::user()->email_verified_code === $request->code) {
                Auth::user()->email_verified = true;
                Auth::user()->save();
                return response()->json([
                    'view' => view('ajax.request.request', [
                        'specialties' => $this->specialties
                    ])->render() 
                ], 200);
            }
            else {
                return response()->json([
                    'errors' => ['Неправильный код подтверждения']
                ], 400);
            }
        }
        catch (Throwable $e) {
            return response()->json([
                'errors' => ['Произошла ошибка на сервере']
            ], 500);
        }
    }

    private function request(Request $request) {
        $messages = [
            'speciality_id.unique' => 'Вы уже подали заявку на эту специальность',
            'documents.required' => 'Загрузите файл'
        ];
        $rules = [ 
            'speciality_id' => Rule::unique('requests')->where(function ($query) {
                return $query->where('enrolle_id', Auth::user()->id);
            }),
            'documents' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        else {
            try {
                $request = Requests::create([
                    'enrolle_id' => Auth::user()->id,
                    'speciality_id' => $request->speciality_id,
                    'path_documents' => $request->file('documents')->store('documents'),
                    'institution_id' => request('institution', 1)
                ]);
                $request->save();
                return response()->json([
                    'redirect' => true,
                    'redirect_url' => route('rating')
                ]);
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => ['Произошла ошибка на сервере'.$e]
                ], 500);
            }
        }
    }
}
