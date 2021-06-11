<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
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
        $kamar = Kamar::get();
        return view('user.kamar', compact('kamar'));
    }

    public function fasilitas()
    {
        $fasilitas = Fasilitas::get();
        return view('user.fasilitas', compact('fasilitas'));
    }

    public function showKamar($id)
    {
        // Query untuk mengambil data kamar dan fasilitas yang berelasi sesuai dengan id kamar
        $kamar = Kamar::with('fasilitas')->findOrFail($id);
        // $reserv = Reservasi::where('kamar_id', $kamar->id)->first();
        return view('user.detail-kamar', compact('kamar'));
    }
}
