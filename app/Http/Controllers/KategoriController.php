<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->search){
            $kategori = DB::table('kategori')->select('id','deskripsi',DB::raw('ketKategori(kategori) as kat'))
                                             ->where('id','like','%'.$request->search.'%')
                                             ->orWhere('deskripsi','like','%'.$request->search.'%')
                                             ->orWhere(DB::raw('ketKategori(kategori)'),'like','%'.$request->search.'%')
                                             ->paginate(10);
        } else {
            $kategori = DB::table('kategori')->select('id','deskripsi',DB::raw('ketKategori(kategori) as kat'))->paginate(10);
        }
        return view('dashboard.kategori.index', ['kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi'  => 'required',
            'kategori'   => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('kategori.create')
                ->withErrors($validator)
                ->withInput();
        }

        Kategori::create([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data kategori berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) 
    {
        $rowkategori = Kategori::findOrFail($id);
        return view('dashboard.kategori.show', compact('rowkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idkat = Kategori::find($id);
        return view('dashboard.kategori.edit', compact('idkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi'  => 'required',
            'kategori'   => 'required|in:M,A,BHP,BTHP'
        ]);
        if ($validator->fails()) {
            return redirect()->route('kategori.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $idkat = Kategori::find($id);
        $idkat->update([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori
        ]);
        return redirect()->route('kategori.index')->with(['success' => 'Data kategori berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()) {
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data kategori gagal dihapus! Data kategori masih digunakan oleh produk']);
        }
        else {
            $idkat = Kategori::find($id);
            $idkat->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data kategori berhasil dihapus!']);
        }
    }
}
