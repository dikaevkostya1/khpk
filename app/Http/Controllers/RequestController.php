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
use App\Institutions;
use App\Enrolle;
use App\Helpers\DeadlineHelpers;
use App\Helpers\SpecialtiesHelpers;
use App\Mail\EnrolleMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{

    protected $requests;

    public function __construct() {
        $this->specialties = SpecialtiesHelpers::get();
        $this->deadline = DeadlineHelpers::get_regis();
        $this->requests = Requests::select('speciality_id')->where('enrolle_id', auth()->id())->pluck('speciality_id');
    }

    public function index(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->email_verified == true) {
                $data = [
                    'specialties' => $this->specialties,
                    'institutions' => Institutions::all(), 
                    'request_stage' => 3,
                    'deadline' => $this->deadline,
                    'requests' => $this->requests,
                    'deadline_info' => DeadlineHelpers::get_info(),
                ];
            }
            else $data = [
                'requests' => $this->requests,
                'request_stage' => 2
            ];
        }
        else {
            $data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'mail' => $request->mail,
                'educations' => Educations::all(),
                'request_stage' => 1,
                'deadline_regis' => DeadlineHelpers::get_regis()
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
            'login.unique' => '?????????? ?????????? ?????? ??????????',     
            'mail.unique' => '?????? ?????????? ?????? ????????????????????????',
            'mail.email' => '???????????????????????? Email',
            'passport.unique' => '?????????? ???????????????????? ???????????? ?????? ????????????????????????',
            'password.min' => '?????????????? 8 ???????????????? ?? ????????????',
            'consent_data.max' => '???????? ?????????????? ??????????????',
            'consent_data.required' => '?????????????????? ????????????????',
        ];
        $rules = [
            'login' => 'unique:enrolle',
            'mail' => 'unique:enrolle|email',
            'passport' => 'unique:enrolle',
            'password' => 'min:8',
            'consent_data' => 'required|max:10240',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        else {
            try {
                if ($request->password == $request->password_apply) {
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
                        'email_verified_code' => random_int(1000, 9999),
                        'consent_data' => Storage::disk('documents')->putFile('consent', $request->file('consent_data')),
                    ]);
                    $enrolle->save();
                    $data = [
                        'name' => $enrolle->full_name,
                        'code' => $enrolle->email_verified_code
                    ];
                    Mail::to($enrolle->mail)->send(new EnrolleMail($data));
                    if (Auth::loginUsingId($enrolle->id)) {
                        return response()->json([
                            'view' => view('request', [
                                'requests' => $this->requests,
                                'request_stage' => 2
                            ])->render()
                        ], 200);
                    }
                }
                else {
                    return response()->json([
                        'errors' => ['???????????? ???? ??????????????????']
                    ], 400);
                }
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => ['?????????????????? ???????????? ???? ??????????????'.$e]
                ], 500);
            }
        }
    }

    private function email_verified(Request $request) {
        try {
            $code = $request->code1.''.$request->code2.''.$request->code3.''.$request->code4;
            if (Auth::user()->email_verified_code == $code) {
                Auth::user()->email_verified = true;
                Auth::user()->save();
                if (count($this->requests) > 0) return response()->json([
                    'redirect' => true,
                    'redirect_url' => route('rating')
                ]);
                else return response()->json([
                    'view' => view('request', [
                        'specialties' => $this->specialties,
                        'request_stage' => 3,
                        'deadline' => $this->deadline,
                        'requests' => $this->requests,
                    ])->render()
                ], 200);
                
            }
            else {
                return response()->json([
                    'errors' => ['???????????????????????? ?????? ??????????????????????????']
                ], 400);
            }
        }
        catch (Throwable $e) {
            return response()->json([
                'errors' => ['?????????????????? ???????????? ???? ??????????????'.$e]
            ], 500);
        }
    }

    private function request(Request $request) {
        $this->middleware('auth');
        $messages = [
            'speciality_id.unique' => '???? ?????? ???????????? ???????????? ???? ?????? ??????????????????????????',
            'documents.required' => '?????????????????? ????????',
            'speciality_id.required' => '???????????????? ??????????????????????????',
            'documents.max' => '???????? ?????????????? ??????????????',
        ];
        $rules = [ 
            'documents' => 'required|max:10240',
            'speciality_id' => 'required', Rule::unique('requests')->where(function ($query) {
                return $query->where('enrolle_id', Auth::user()->id);
            }),
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        else {
            try {
                foreach (json_decode($request->speciality_id) as $speciality) {
                    $requests = Requests::create([
                        'enrolle_id' => Auth::user()->id,
                        'speciality_id' => $speciality,
                        'path_documents' => Storage::disk('documents')->putFile('documents', $request->file('documents')),
                        'institution_id' => $request->institution_id
                    ]);
                    $requests->save();
                }
                return response()->json([
                    'redirect' => true,
                    'redirect_url' => route('rating')
                ]);
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => ['?????????????????? ???????????? ???? ??????????????'.$e]
                ], 500);
            }
        }
    }
}
