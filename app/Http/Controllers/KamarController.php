<?php

namespace App\Http\Controllers;

use App\Http\Requests\KamarRequest;
use App\Models\Fasilitas;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\deleteFile;
use function App\Helpers\updateFile;
use function App\Helpers\uploadFile;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Kamar::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($data) {
                    if ($data->image) {
                        return '<img class="img-thumbnail w-100" src="' . $data->image . '" />';
                    }
                    return '<img class="img-thumbnail w-100" src="img/not.png" />';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/kamar/' . $data->id . '/edit" class="btn btn-sm btn-info"><i class="fas fa-edit text-light"></i></a>';
                    $button .= '<a href="/kamar/' . $data->id . '" class="btn btn-sm btn-success"><i class="fas fa-eye text-light"></i></a>';
                    $button .= '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-id="' . $data->id . '" data-bs-target="#deleteKamarModal" class="btn btn-sm btn-danger btn-delete-kamar text-light"><i class="fas fa-trash"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('admin.kamar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.kamar.create', compact('fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarRequest $request)
    {
        $payload = $request->only(['name', 'description', 'price']);
        if ($request->hasFile('image')) {
            $payload['image'] = uploadFile($request->file('image'), 'hotelly');
        }
        $kamar = Kamar::create($payload);
        if ($request->fasilitas) $kamar->fasilitas()->sync($request->fasilitas);
        return redirect()->route('kamar.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = Kamar::with('fasilitas')->findOrFail($id);
        return view('admin.kamar.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::all();
        $data  = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('fasilitas', 'data'));
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
        $kamar = Kamar::findOrFail($id);
        $payload = $request->only(['name', 'description', 'price']);
        if ($request->hasFile('image')) {
            $payload['image'] = updateFile($kamar->image, 'kamar', $request->file('image'), 'kamar');
        } else {
            $payload['image'] = $kamar->image;
        }
        $kamar->update($payload);
        if ($request->fasilitas) $kamar->fasilitas()->sync($request->fasilitas);
        return redirect()->route('kamar.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        if ($kamar->image) {
            deleteFile($kamar->image, 'kamar');
        }
        if ($kamar->fasilitas) $kamar->fasilitas()->detach();
        $kamar->delete();
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }

    public function kamarFasilitas($id)
    {
        $kamar = Kamar::with('fasilitas')->findOrFail($id);
        $fasilitas = [];
        foreach ($kamar->fasilitas as $fac) {
            $fasilitas[] = $fac->pivot->fasilitas_id;
        }
        return response()->json($fasilitas);
    }
}
