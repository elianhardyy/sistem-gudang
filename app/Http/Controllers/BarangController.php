<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with(['supplier', 'kategori', 'lokasi', 'mutasis'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Barang',
            'data' => $barangs
        ], 200);
    }

    public function dashboard()
    {
        $totalBarang = Barang::count();
        $totalMutasi = Mutasi::count();
        $barangHabis = Barang::where('stok', '<', 5)->get(); // Barang dengan stok kurang dari 5

        return response()->json([
            'total_barang' => $totalBarang,
            'total_mutasi' => $totalMutasi,
            'barang_habis' => $barangHabis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|unique:barangs',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tanggal_masuk' => 'nullable|date',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'lokasi_id' => 'nullable|exists:lokasis,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 400);
        }
        $kategori = Kategori::find($request->kategori_id);
        $kodeUnikBarang = $kategori->kode_unik . $request->kode;
        // Create new Barang
        $barang = Barang::create(array_merge($request->all(),['kode'=>$kodeUnikBarang]));

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan',
            'data' => $barang
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::with(['supplier', 'kategori', 'lokasi', 'mutasis'])->find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Barang',
            'data' => $barang
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        // Validation data
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|unique:barangs,kode,' . $barang->id,
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tanggal_masuk' => 'nullable|date',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'lokasi_id' => 'nullable|exists:lokasis,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        // Update barang
        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diperbarui',
            'data' => $barang
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus',
        ], 200);

    }
}
