<?php

namespace App\Http\Controllers;

class HomePageController extends Controller
{
    public function __invoke()
    {
        return view('inn.form');
    }
}
