<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'var' => 'home'
        ];
        return view('home', $data);
    }
}
