<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemesananRequest;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $exists = Reservasi::where('kamar_id', $kamar->id)->first();
        return view('user.detail-kamar', compact('kamar', 'exists'));
    }

    public function pemesanan(PemesananRequest $request)
    {
        $user = Auth::user();
        $no_code = Reservasi::where('user_id', $user->id)->count();
        $exists = Reservasi::where('kamar_id', $request->room_id)->first();
        if ($exists) {
            return redirect()->back()->with('warning', 'Kamar sudah dalam pesanan');
        }
        $payload = $request->only(['kamar_id', 'guest', 'check_out', 'check_in']);
        $code = 'RSV' . str_pad(($no_code + 1), '5', '0', STR_PAD_LEFT);
        $payload['user_id'] = $user->id;
        $payload['code'] = $code;
        Reservasi::create($payload);
        return redirect()->route('pemesanan.index');
    }
}