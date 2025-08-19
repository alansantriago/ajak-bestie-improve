<?php

namespace App\Http\Controllers;

class FirstController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.beranda');
    }
    public function tentang()
    {
        return view('dashboard.tentang');
    }
    public function kontak()
    {
        return view('dashboard.kontak');
    }
    public function login()
    {
        return view('dashboard');
    }
}
