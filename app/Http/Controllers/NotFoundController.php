<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        // if (auth()->check()) {
            return view('layouts.dashboard');
        // }

        // return abort('404');
    }
}
