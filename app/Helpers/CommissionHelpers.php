<?php
namespace App\Helpers;

use App\Commission;
use Carbon\Carbon;

class CommissionHelpers
{

    public static function get() {
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
            if (Carbon::now()->dayOfWeek >= $commission->start_week && Carbon::now()->dayOfWeek <= $commission->ending_week && Carbon::now()->diffInMinutes($commission->start_time) >= 0 && Carbon::now()->diffInMinutes($commission->ending_time) <= 0) {
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
        return $commission;
    }
}