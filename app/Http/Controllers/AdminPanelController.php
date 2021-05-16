<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Deadline;
use App\Educations;
use App\Enrolle;
use Illuminate\Support\Str;
use App\Exports\RequestExport;
use App\Helpers\CommissionHelpers;
use App\Helpers\DeadlineHelpers;
use App\Helpers\SpecialtiesHelpers;
use App\Institutions;
use App\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_admin');
        $this->now = Carbon::now();
        $this->year = $this->now->format('Y');
        $this->deadline = DeadlineHelpers::get_info();
        $this->specialties = SpecialtiesHelpers::get();
    }

    public function index(Request $request) {
        $admin = Auth::guard('admin')->user();
        $commission = CommissionHelpers::get();
        return view('admin.admin', [
            'year' => $this->year,
            'admin' => $admin,
            'deadline' => $this->deadline,
            'requests' => Requests::where('institution_id', $admin->institution_id)->get(),
            'requests_new' => Requests::where('institution_id', $admin->institution_id)->where('status_id', 1)->get(),
            'commission' => $commission
        ]);
    }

    public function request(Request $request) {
        $messages = [   
            'mail.unique' => 'Эта почта уже используется',
            'mail.email' => 'Неккоректный Email',
            'passport.unique' => 'Такие паспортные данные уже используются',
            'consent_data.max' => 'Файл слишком большой',
            'consent_data.required' => 'Загрузите согласие',
        ];
        $rules = [
            'mail' => 'unique:enrolle|email',
            'passport' => 'unique:enrolle',
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
                $login = Str::slug($request->login);
                $password = Str::random(8);
                $enrolle = Enrolle::create([
                    'full_name' => $request->surname . ' ' . $request->name . ' ' . $request->middlename,
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
                    'login' => $login,
                    'mail' => $request->mail,
                    'password' => Hash::make($password),
                    'remember_token' => Hash::make(Str::random(5)),
                    'email_verified_code' => random_int(1000, 9999),
                    'consent_data' => Storage::disk('documents')->putFile('consent', $request->file('consent_data')),
                ]);
                $enrolle->save();
                $data = [
                    'name' => $enrolle->full_name,
                    'login' => $login,
                    'password' => $password
                ];
                Mail::to($enrolle->mail)->send(new EnrolleLoginMail($data));
                if (Auth::loginUsingId($enrolle->id)) {
                    return response()->json([
                        'view' => view('request', [
                            'request_stage' => 2
                        ])->render()
                    ], 200);
                }
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => ['Произошла ошибка на сервере']
                ], 500);
            }
        }
    }

    public function enrolle() {
        $admin = Auth::guard('admin')->user();
        $data = [
            'admin' => $admin,
            'educations' => Educations::all(),
            'specialties' => $this->specialties,
            'institutions' => Institutions::all(), 
            'deadline' => DeadlineHelpers::get_regis(),
            'deadline_info' => $this->deadline
        ];
        return view('admin.enrolle', $data);
    }

    public function info() {
        $admin = Auth::guard('admin')->user();
        $commission = CommissionHelpers::get();
        return view('admin.info', [
            'year' => $this->year,
            'admin' => $admin,
            'deadline' => $this->deadline,
            'commission' => $commission
        ]);
    }

    public function deadline(Request $request) {
        try {
            $admin = Auth::guard('admin')->user();
            Deadline::updateOrCreate(
                [
                    'year' => $this->year,
                    'format_id' => $request->format,
                    'institution_id' => $admin->institution_id
                ],
                [
                    'start' => Carbon::parse($request->start . '.' . $this->year)->format('Y-m-d'),
                    'ending' => Carbon::parse($request->ending . '.' . $this->year)->format('Y-m-d')
                ]
            );
            return redirect()->back();
        } 
        catch(Throwable $e) {
            $rule = [
                'message' => 'Произошла ошибка. Проверьте правильность введенных вами данных'
            ];
            return redirect()->back()->withInput()->withErrors($rule);
        }
    }

    public function commission(Request $request) {
        try {
            $admin = Auth::guard('admin')->user();
            Commission::updateOrCreate(
                [
                    'institution_id' => $admin->institution_id
                ],
                [
                    'start_week' => $request->start_week,
                    'ending_week' => $request->ending_week,
                    'start_time' => $request->start_time,
                    'ending_time' => $request->ending_time,
                    'start_dinner' => $request->start_dinner,
                    'ending_dinner' => $request->ending_dinner
                ]
            );
            return response()->json([
                'redirect' => true,
                'redirect_url' => '/admin/info'
            ]);
        }
        catch (Throwable $e) {
            return response()->json([
                'errors' => ['Произошла ошибка на сервере'.$e]
            ], 500);
        }
        
    }

    public function export_request($id) {
        $admin = Auth::guard('admin')->user();
        return Excel::download(new RequestExport($admin->institution_id, $id), 'заявки.xlsx');
    }
}
