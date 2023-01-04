<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Admin\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
