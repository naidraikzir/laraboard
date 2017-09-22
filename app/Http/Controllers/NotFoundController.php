<?php

namespace App\Http\Controllers;

class NotFoundController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('layouts.dashboard');
        }

        return abort('404');
    }
}
