<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{

    public function request($doc) {
        return Storage::download('/documents/request/'.$doc);
    }
}
