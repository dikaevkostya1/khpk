<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Institutions;
use App\Helpers\CommissionHelpers;
use App\Helpers\DeadlineHelpers;
use App\Helpers\SpecialtiesHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
        $commission = CommissionHelpers::get();
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
                    'institution_id' => $request->institution_id
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
