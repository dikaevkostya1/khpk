<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Deadline;
use App\Exports\RequestExport;
use App\Helpers\CommissionHelpers;
use App\Helpers\DeadlineHelpers;
use App\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_admin');
        $this->now = Carbon::now();
        $this->year = $this->now->format('Y');
        $this->deadline = DeadlineHelpers::get_info();
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

    public function export_request() {
        $admin = Auth::guard('admin')->user();
        return Excel::download(new RequestExport($admin->institution_id), 'заявки.xlsx');
    }
}
