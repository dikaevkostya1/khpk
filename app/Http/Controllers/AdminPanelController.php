<?php

namespace App\Http\Controllers;

use App\Deadline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_admin');
        $this->now = Carbon::now();
        $this->year = $this->now->format('Y');
    }

    public function index(Request $request) {
        $admin = Auth::guard('admin')->user();
        $deadline = Deadline::where('institution_id', $admin->institution_id)
                            ->where('ending', '>=', $this->now)
                            ->where('format_id', request('d', 1))
                            ->where('year', $this->year)
                            ->first();
        if ($deadline) {
            $deadline->start = Carbon::parse($deadline->start);
            $deadline->ending = Carbon::parse($deadline->ending);
        }
        return view('admin.admin', [
            'now' => $this->now,
            'admin' => $admin,
            'deadline' => $deadline,
            'format' => $request->d
        ]);
    }

    public function deadline(Request $request) {
        $admin = Auth::guard('admin')->user();
        $deadline = Deadline::where('year', $this->year)
                            ->where('format_id', $request->format)
                            ->where('institution_id', $admin->institution_id)
                            ->first();
        if ($deadline) {
            $deadline->start = $request->start;
            $deadline->ending = $request->ending;
            $deadline->save();
        }
        else {
            $deadline = Deadline::create([
                'start' => $request->start,
                'ending' => $request->ending,
                'format_id' => $request->format,
                'institution_id' => $admin->institution_id,
                'year' => $this->year
            ]);
            $deadline->save();
        }
        return redirect()->back();
    }
}
