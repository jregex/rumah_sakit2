<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'var' => 'dashboard'
        ];
        return view('admin.dashboard', $data);
    }
}
