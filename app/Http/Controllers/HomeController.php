<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Institutions;
use App\Commission;
use App\Helpers\DeadlineHelpers;
use App\Helpers\SpecialtiesHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class HomeController extends Controller
{

    public function __construct() {
        $this->deadline = DeadlineHelpers::get_info();
        $this->specialties = SpecialtiesHelpers::get();
        $this->now = Carbon::now();
        $this->year = $this->now->format('Y');
    }

    public function index() {
        $commission = Commission::where('institution_id', request('institution', 1))->first();
        $day_week = [
            ['ПН', 'понедел...'],
            ['ВТ', 'вторник'],
            ['СР', 'среда'],
            ['ЧТ', 'четверг'],
            ['ПТ', 'пятница'],
            ['СБ', 'суббота'],
            ['ВС', 'воскрес...']
        ];
        if ($commission) {
            $commission->start_day = $day_week[$commission->start_week][0];
            $commission->start_day_sign = $day_week[$commission->start_week][1];
            $commission->ending_day = $day_week[$commission->ending_week][0];
            $commission->ending_day_sign = $day_week[$commission->ending_week][1];
            $commission->start_time = Carbon::parse($commission->start_time);
            $commission->ending_time = Carbon::parse($commission->ending_time);
            $commission->start_dinner = Carbon::parse($commission->start_dinner);
            $commission->ending_dinner = Carbon::parse($commission->ending_dinner);
            if ($this->now->dayOfWeek >= $commission->start_week && $this->now->dayOfWeek <= $commission->ending_week && $this->now->diffInMinutes($commission->start_time) >= 0 && $this->now->diffInMinutes($commission->ending_time) <= 0) {
                $commission->status = 'Открыто';
            }
            else $commission->status = 'Закрыто';
        }
        else {
            $commission = new \stdClass();
            $commission->status = html_entity_decode('&mdash;');
            $commission->start_day = '?';
            $commission->start_day_sign = '';
            $commission->ending_day = '?';
            $commission->ending_day_sign = '';
            $commission->start_time = Carbon::parse('00:00');
            $commission->ending_time = Carbon::parse('00:00');
            $commission->status_block = 'Неизвестно';
        }
        $data = [
            'institutions' => Institutions::all(),
            'specialties' => $this->specialties,
            'deadline' => $this->deadline,
            'now' => $this->now,
            'commission' => $commission
        ];
        return view('home', $data);
    }

    public function feedback(Request $request) {
        $messages = [
            'mail.email' => 'Неккоректный Email',
        ];
        $rules = [ 
            'mail' => 'email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        else {
            try {
                $feedback = Feedback::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'mail' => $request->mail,
                    'message' => $request->message,
                    'institution_id' => request('institutions', 1)
                ]);
                $feedback->save();
                return response()->json([
                    'message' => 'Успешно отправлено'
                ], 200);
            }
            catch (Throwable $e) {
                return response()->json([
                    'errors' => 'Произошла ошибка на сервере'
                ], 500);
            }
        }
    }

}
