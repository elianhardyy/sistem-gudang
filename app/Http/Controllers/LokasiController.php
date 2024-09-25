<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasis = Lokasi::all();
        return response()->json([
            'success'=>true,
            'message'=>'Daftar Lokasi',
            'data'=>$lokasis
        ],200);
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
        $validation = $request->validate([
            'nama_lokasi'=>'required',
            'deskripsi'=>'required'
        ]);
        $lokasi = Lokasi::create($validation);
        return response()->json([
            'success'=>true,
            'message'=>'Lokasi berhasil ditambahkan',
            'data'=>$lokasi
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = Lokasi::find($id);
        if(!$lokasi){
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail Lokasi',
            'data' => $lokasi
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
        $lokasi = Lokasi::find($id);
        if(!$lokasi){
            return response()->json([
                'success'=>false,
                'message'=>'Lokasi tidak ditemukan'
            ],404);
        }
        $validation = $request->validate([
            'nama_lokasi'=>'required',
            'deskripsi'=>'required'
        ]);
        $lokasi->update($validation);
        return response()->json([
            'success'=>true,
            'message'=>'Lokasi berhasil diperbarui',
            'data'=>$lokasi
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = Lokasi::find($id);
        if(!$lokasi){
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak ditemukan',
            ], 404);
        }
        $lokasi->delete();
        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil dihapus',
        ], 200);
    }
}
