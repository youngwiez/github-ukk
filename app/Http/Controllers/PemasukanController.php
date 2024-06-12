<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // menggunakan eloquent
        if ($request->search) {
            $pemasukan = Pemasukan::select('pemasukan.*', 'barang.seri as seri')
                            ->join('barang', 'pemasukan.barang_id', '=', 'barang.id')
                            ->where('pemasukan.id','like','%'.$request->search.'%')
                            ->orWhere('pemasukan.tgl_masuk','like','%'.$request->search.'%')
                            ->orWhere('pemasukan.qty_masuk','like','%'.$request->search.'%')
                            ->orWhereHas('barang', function($query) use ($request) {
                                $query->where('seri','like','%'.$request->search.'%')
                                    ->orWhere('merk','like','%'.$request->search.'%');
                            })
                            ->paginate(3);
        } else {
            $pemasukan = Pemasukan::select('pemasukan.*', 'barang.seri as seri')
                                    ->join('barang', 'pemasukan.barang_id', '=', 'barang.id')
                                    ->paginate(3);
        }
        return view('dashboard.pemasukan.index', ['pemasukan' => $pemasukan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = DB::table('barang')->get();
        return view('dashboard.pemasukan.create', ['barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pemasukan.create')
                ->withErrors($validator)
                ->withInput();
        }
        Pemasukan::create([
            'tgl_masuk'  => now()->toDateString(),
            'qty_masuk'  => $request->qty_masuk,
            'barang_id'  => $request->barang_id
        ]);
        return redirect()->route('pemasukan.index')->with(['success' => 'Data Pemasukan Barang Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rowmasuk = Pemasukan::select('pemasukan.*', 'barang.seri as seri')
                                ->join('barang', 'pemasukan.barang_id', '=', 'barang.id')
                                ->findOrfail($id);
        return view('dashboard.pemasukan.show', compact('rowmasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idmasuk = Pemasukan::find($id);
        $barang_id = Barang::all();
        return view('dashboard.pemasukan.edit', compact('idmasuk','barang_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'qty_masuk'  => 'required',
            'barang_id'   => 'required'
        ]);
        $barang_id = Pemasukan::find($id);
        $barang_id->update([
            'tgl_masuk'  => now()->toDateString(),
            'qty_masuk'  => $request->qty_masuk,
            'barang_id'  => $request->barang_id
        ]);
        return redirect()->route('pemasukan.index')->with(['success' => 'Data Pemasukan Barang Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang_id = Pemasukan::find($id);
        $barang_id->delete();
        return redirect()->route('pemasukan.index')->with(['success' => 'Data Pemasukan Barang Berhasil Dihapus!']);
    }
}
