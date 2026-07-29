<?php

namespace App\Http\Controllers;

class DashbordController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
