<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservasiRequest;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Reservasi::with('user', 'kamar')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<a href="#" class="btn btn-sm btn-danger text-light btn-edit-status" data-bs-toggle="modal"
                data-bs-target="#editStatusModal"
                data-id="' . $data->id . '">Belum Diverifikasi</a>';
                    }
                    return '<a href="#" class="btn btn-sm btn-success text-light btn-edit-status" data-bs-toggle="modal"
                data-bs-target="#editStatusModal"
                data-id="' . $data->id . '">Sudah Diverifikasi</a>';
                })
                ->editColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->editColumn('kamar', function ($data) {
                    return $data->kamar->name;
                })
                ->editColumn('total', function ($data) {
                    return "Rp. " . number_format($data->guest * $data->kamar->price, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/reservasi/' . $data->id . '/edit" class="btn btn-sm btn-info"><i class="fas fa-edit text-light"></i></a>';
                    // $button .= '<a href="/reservasi/' . $data->id . '" class="btn btn-sm btn-success"><i class="fas fa-eye text-light"></i></a>';
                    $button .= '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-id="' . $data->id . '" data-bs-target="#deleteReservasiModal" class="btn btn-sm btn-danger btn-delete-reservasi text-light"><i class="fas fa-trash"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'name', 'kamar', 'total', 'status'])
                ->make(true);
        }
        return view('admin.reservasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('role', 'usr')->get();
        $kamar = Kamar::get();
        return view('admin.reservasi.create', compact('user', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservasiRequest $request)
    {
        $payload = $request->only(['user_id', 'kamar_id', 'check_in', 'check_out', 'guest', 'description']);
        $latest = Reservasi::orderBy('created_at', 'DESC')->first();
        $payload['code'] = 'RSV' . str_pad(($latest ?  $latest->id : 1), 6, "0", STR_PAD_LEFT);
        Reservasi::create($payload);
        return redirect()->route('reservasi.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('role', 'usr')->get();
        $kamar = Kamar::get();
        $data = Reservasi::with('user', 'kamar')->findOrFail($id);
        return view('admin.reservasi.show', compact('user', 'kamar', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('role', 'usr')->get();
        $kamar = Kamar::get();
        $data = Reservasi::with('user', 'kamar')->findOrFail($id);
        return view('admin.reservasi.edit', compact('user', 'kamar', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = $request->only(['user_id', 'kamar_id', 'check_in', 'check_out', 'guest', 'description']);
        Reservasi::findOrFail($id)->update($payload);
        return redirect()->route('reservasi.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();
        return response()->json(['success' => true], 200);
    }

    public function editStatus(Request $request, $id)
    {
        $reserv = Reservasi::findOrFail($id);
        $reserv->update([
            'status' => $request->status
        ]);
        return response()->json(['success' => true], 200);
    }

    public function getStatus($id)
    {
        $reserv = Reservasi::findOrFail($id);
        return response()->json(['data' => $reserv], 200);
    }
}