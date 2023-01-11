<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;
        $role = Auth::user()->role_name;
        return view('admin/index', compact('name', 'role'));
    }
}
