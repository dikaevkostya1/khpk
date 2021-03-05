<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialties;
use App\Feedback;
use Throwable;

class HomeController extends Controller
{

    public function __construct()
    {
        $specialties = Specialties::query();
        $specialties->when(request('finansing', 1), function ($q, $filter) {
            return $q->where('finansing_id', $filter);
        });
        $specialties->when(request('format', 1), function ($q, $filter) {
            return $q->where('format_id', $filter);
        });
        $specialties = [
            'specialties' => $specialties->get()
        ];
        $this->specialties = $specialties;
    }

    public function index() {
        return view('home', $this->specialties);
    }

    public function filter() {
        return view('ajax.home.specialties', $this->specialties);
    }

    public function feedback(Request $request) {
        try {
            $feedback = Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'message' => $request->message,
                'institution_id' => 1
            ]);
            $feedback->save();
            return 'Успешно отправлено';
        }
        catch (Throwable $e) {
            return 'Произошла ошибка';
        }
    }

}
