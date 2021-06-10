<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Query untuk mengambil 3 data kamar terakhir
        $kamar = Kamar::latest()->limit(3)->get();
        return view('welcome', compact('kamar'));
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
        // Query untuk mengambil data kamar dan fasilitas yang berelasi sesuai dengan id kamar
        $kamar = Kamar::with('fasilitas')->findOrFail($id);
        // $reserv = Reservasi::where('kamar_id', $kamar->id)->first();
        return view('user.detail-kamar', compact('kamar'));
    }
}