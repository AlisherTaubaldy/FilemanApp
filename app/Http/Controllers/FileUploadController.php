<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('upload');  // Отобразит Blade-шаблон
    }
}
