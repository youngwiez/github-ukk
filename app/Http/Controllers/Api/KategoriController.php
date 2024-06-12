<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data kategori gagal disimpan!',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            DB::beginTransaction();
            $kategori = Kategori::create([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori
            ]);
            DB::commit();
            return response()->json($kategori, 201);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data kategori!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);
        if (($kategori) == null) {
            return response()->json(['status' => 'Data kategori tidak ditemukan!'], 404);
        }
        return response()->json($kategori);
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
            return response()->json([
                'message' => 'Data kategori gagal diedit!',
                'errors' => $validator->errors()
            ], 422);
        }
        $idkat = Kategori::find($id);
        try {
            DB::beginTransaction();
            $idkat->update([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori
            ]);
            DB::commit();
            return response()->json('Data kategori berhasil diubah!', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengubah data kategori!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()) {
            return response()->json('Data kategori gagal dihapus! Data kategori masih digunakan oleh produk');
        }
        else {
            $idkat = Kategori::find($id);
            $idkat->delete();
            return response()->json('Data kategori berhasil dihapus!');
        }
    }
}
