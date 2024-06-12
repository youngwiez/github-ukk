<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // menggunakan eloquent
        if ($request->search) {
            $pengeluaran = Pengeluaran::select('pengeluaran.*', 'barang.seri as seri')
                            ->join('barang', 'pengeluaran.barang_id', '=', 'barang.id')
                            ->where('pengeluaran.id','like','%'.$request->search.'%')
                            ->orWhere('pengeluaran.tgl_keluar','like','%'.$request->search.'%')
                            ->orWhere('pengeluaran.qty_keluar','like','%'.$request->search.'%')
                            ->orWhereHas('barang', function($query) use ($request) {
                                $query->where('seri','like','%'.$request->search.'%')
                                    ->orWhere('merk','like','%'.$request->search.'%');
                            })
                            ->paginate(3);
        } else {
            $pengeluaran = Pengeluaran::select('pengeluaran.*', 'barang.seri as seri')
                                    ->join('barang', 'pengeluaran.barang_id', '=', 'barang.id')
                                    ->paginate(3);
        }
        return view('dashboard.pengeluaran.index', ['pengeluaran' => $pengeluaran]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = DB::table('barang')->get();
        return view('dashboard.pengeluaran.create', ['barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barang,id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('pengeluaran.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        $barang = DB::table('barang')->where('id', $request->barang_id)->first();
    
        if ($barang->stok < $request->qty_keluar) {
            return redirect()->route('pengeluaran.create')
                ->withErrors(['qty_keluar' => 'Stok yang dimasukkan melebihi jumlah barang yang tersedia'])
                ->withInput();
        }
    
        Pengeluaran::create([
            'tgl_keluar' => now()->toDateString(),
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id
        ]);

        DB::table('barang')->where('id', $request->barang_id);
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data Pengeluaran Barang Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rowkeluar = Pengeluaran::select('pengeluaran.*', 'barang.seri as seri')
                                ->join('barang', 'pengeluaran.barang_id', '=', 'barang.id')
                                ->findOrfail($id);
        return view('dashboard.pengeluaran.show', compact('rowkeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idkeluar = Pengeluaran::find($id);
        $barang_id = Barang::all();
        return view('dashboard.pengeluaran.edit', compact('idkeluar','barang_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'qty_keluar'  => 'required',
            'barang_id'   => 'required'
        ]);
        $barang_id = Pengeluaran::find($id);
        $barang_id->update([
            'tgl_keluar'  => now()->toDateString(),
            'qty_keluar'  => $request->qty_keluar,
            'barang_id'   => $request->barang_id
        ]);
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data Pengeluaran Barang Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang_id = Pengeluaran::find($id);
        $barang_id->delete();
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data Pengeluaran Barang Berhasil Dihapus!']);
    }
}
