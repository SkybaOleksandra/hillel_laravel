<?php

namespace App\Http\Controllers\Admin;


class PageController extends Controller
{
    public function index()
    {
        return view('admin/index');
    }
}
