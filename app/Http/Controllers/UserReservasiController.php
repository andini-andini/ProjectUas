<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Reservasi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\dateDiffInDays;

class UserReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Reservasi::with('user', 'kamar')->where('user_id', Auth::user()->id)->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<button type="button" class="btn btn-sm btn-danger text-light">Belum Verifikasi</button>';
                    }
                    return '<button type="button" class="btn btn-sm btn-success text-light">Sudah Verifikasi</button>';
                })
                ->editColumn('kamar', function ($data) {
                    return $data->kamar->name;
                })
                ->editColumn('total', function ($data) {
                    return "Rp. " . number_format($data->guest * $data->kamar->price, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if ($data->status == 0) {
                        $button .= '<a href="/pemesanan/' . $data->id . '/edit" class="btn btn-sm btn-info"><i class="fas fa-edit text-light"></i></a>';
                    } else {
                        $button .= '<a href="/pemesanan/cetak-resi/' . $data->id . '" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-download text-light"></i></a>';
                    }
                    $button .= '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-id="' . $data->id . '" data-bs-target="#showPemesananModal" class="btn btn-sm btn-success btn-show-pemesanan text-light"><i class="fas fa-eye"></i></a>';
                    $button .= '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-id="' . $data->id . '" data-bs-target="#deletePemesananModal" class="btn btn-sm btn-danger btn-delete-pemesanan text-light"><i class="fas fa-trash"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'kamar', 'total', 'status'])
                ->make(true);
        }
        return view('user.reservasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Reservasi::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();
        $cin = $data->check_in;
        $cout = $data->check_out;
        $price = $data->kamar->price;
        $day = dateDiffInDays($cin, $cout);
        $total = $day * $price;
        $dataPrice = [
            'days' => $day,
            'totalPrice' => $total,
            'price' => $price
        ];
        return response()->json(['html' => view('admin.reservasi.show', compact('data', 'dataPrice'))->render()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kamar = Kamar::get();
        $data = Reservasi::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();;
        return view('user.reservasi.edit', compact('kamar', 'data'));
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
        $payload = $request->only(['kamar_id', 'check_in', 'check_out', 'guest', 'description']);
        $exists = Reservasi::all();
        foreach ($exists as $item) {
            if ($request->kama_id == $item->id) {
                return redirect()->back()->with('error', 'Kamar sudah dalam pesanan');
            }
        }
        Reservasi::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->update($payload);
        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservasi::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->delete();
        return response()->json(['success' => true], 200);
    }

    public function cetakResi($id)
    {
        $data = Reservasi::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();
        $cin = $data->check_in;
        $cout = $data->check_out;
        $price = $data->kamar->price;
        $day = dateDiffInDays($cin, $cout);
        $total = $day * $price;
        $dataPrice = [
            'days' => $day,
            'totalPrice' => $total,
            'price' => $price
        ];
        $pdf = PDF::loadview('user.reservasi.print', ['data' => $data, 'dataPrice' => $dataPrice]);
        return $pdf->stream();
    }
}