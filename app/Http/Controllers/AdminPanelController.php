<?php

namespace App\Http\Controllers;

use App\AdminUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_admin');
    }

    public function index() {
        return view('admin.admin', [
            'admin' => Auth::guard('admin')->user()
        ]);
    }
}
