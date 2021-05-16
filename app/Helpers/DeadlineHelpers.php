<?php
namespace App\Helpers;

use App\Deadline;
use Carbon\Carbon;

class DeadlineHelpers
{

    public function __construct()
    {
        $this->now = Carbon::now();
        $this->deadline = Deadline::where('institution_id', request('institution', 1))
            ->where('format_id', request('format', 1))
            ->where('year', $this->now->format('Y'));
    }

    public function info() {
        $deadline = $this->deadline->first();
        if ($deadline) {
            $start = Carbon::parse($deadline->start);
            $deadline->start = $start->format('d');
            $deadline->start_sign = $start->formatLocalized('%B');
            $ending = Carbon::parse($deadline->ending);
            $deadline->ending = $ending->format('d');
            $deadline->ending_sign = $ending->formatLocalized('%B');
            if ($start <= $this->now && $ending >= $this->now) $deadline->status = 'начат';
            else if ($start > $this->now) $deadline->status = 'не начат';
            else if ($ending < $this->now) $deadline->status = 'завершился';
            else $deadline->status = 'сроки не установлены';
        }
        else {
            $deadline = new \stdClass();
            $deadline->start = '?';
            $deadline->ending = '?';
            $deadline->start_sign = '';
            $deadline->ending_sign = '';
            $deadline->status = 'сроки не установлены';
        }
        return $deadline;
    }

    public function start_deadline() {
        $deadline = $this->deadline->where('start', '<=', $this->now)->first();
        return $deadline;
    }

    public function regis_deadline() {
        $deadline = $this->deadline->where('start', '<=', $this->now)->where('ending', '>=', $this->now)->where('year', $this->now->format('Y'))->first();
        return $deadline;
    }

    public static function get_info() {
        $class = new DeadlineHelpers();
        return $class->info();
    }

    public static function get() {
        $class = new DeadlineHelpers();
        return $class->start_deadline();
    }

    public static function get_regis() {
        $class = new DeadlineHelpers();
        return $class->regis_deadline();
    }

}