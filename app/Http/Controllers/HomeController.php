<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display root page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->check()
            ? redirect('calendar')
            : view('welcome');
    }
}
