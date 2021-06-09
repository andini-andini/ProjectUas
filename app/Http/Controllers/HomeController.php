<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function kamar()
    {
        return view('user.kamar');
    }

    public function fasilitas()
    {
        return view('user.fasilitas');
    }

    public function showKamar($id)
    {
        return view('user.detail-kamar');
    }
}