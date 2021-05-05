<?php

namespace App\Http\Controllers;

use App\Deadline;
use Illuminate\Http\Request;
use App\Specialties;
use App\Feedback;
use App\Institutions;
use App\Commission;
use Carbon\Carbon;
use Throwable;

class HomeController extends Controller
{

    public function __construct()
    {
        $specialties = Specialties::query();
        
        $specialties->when(request('institution', 1), function ($q, $filter) {
            return $q->where('institution_id', $filter);
        });
        $this->specialties = $specialties->get();
        $this->now = Carbon::now();
        $this->year = $this->now->format('Y');
    }

    public function index() {
        $deadline = Deadline::where('institution_id', request('institution', 1))
                            ->where('ending', '>=', $this->now)
                            ->where('format_id', request('format', 1))
                            ->where('year', $this->year)
                            ->first();
        if ($deadline) {
            $start = Carbon::parse($deadline->start);
            $deadline->start = $start->format('d');
            $deadline->start_sign = $start->formatLocalized('%B');
            $ending = Carbon::parse($deadline->ending);
            $deadline->ending = $ending->format('d');
            $deadline->ending_sign = $ending->formatLocalized('%B');
        }
        else {
            $deadline = new \stdClass();
            $deadline->start = '?';
            $deadline->ending = '?';
            $deadline->start_sign = '';
            $deadline->ending_sign = '';
        }
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
            $commission->status = '';
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
            'deadline' => $deadline,
            'now' => $this->now,
            'commission' => $commission
        ];
        return view('home', $data);
    }

    public function load_info() {
        $data = [
            'deadline' => $this->deadline,
            'now' => $this->now,
        ];
        return view('ajax.home.info', $data);
    }

    public function feedback(Request $request) {
        try {
            $feedback = Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'message' => $request->message,
                'institution_id' => request('institutions', 1)
            ]);
            $feedback->save();
            return 'Успешно отправлено';
        }
        catch (Throwable $e) {
            return 'Заполните все поля';
        }
    }

}
