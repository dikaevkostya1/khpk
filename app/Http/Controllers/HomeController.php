<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialties;
use App\Feedback;
use App\Institutions;
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
        $specialties->when(request('institution', 1), function ($q, $filter) {
            return $q->where('institution_id', $filter);
        });
        $this->specialties = [
            'specialties' => $specialties->get()
        ];
    }

    public function index() {
        $institutions = [
            'institutions' => Institutions::all()
        ];
        $data = array_merge($institutions, $this->specialties);
        return view('home', $data);
    }

    public function ajax_specialties() {
        return response()->json([
            'view' => view('ajax.home.specialties', $this->specialties)->render()
        ], 200);
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
            return 'Произошла ошибка на сервере';
        }
    }

}
