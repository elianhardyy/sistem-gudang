<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mutasis = Mutasi::with(['barang','user','lokasiAsal','lokasiTujuan'])->get();
        return response()->json([
            'success'=>true,
            'message'=>'Daftar Mutasi',
            'data'=>$mutasis
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
        $barang = Barang::find($request->barang_id);
        //$dataExcept
        if ($request->jenis_mutasi == 'keluar' && $request->jumlah > $barang->stok) {
            return response()->json(['error' => 'Stok tidak mencukupi'], 400);
        }
        $userId = Auth::id();
        $lokasiAsal = $barang->lokasi_id;
        $mutasi = Mutasi::create(array_merge($request->all(), ['user_id' => $userId, 'lokasi_asal_id'=>$lokasiAsal]));
        
        // Update stok barang
        if ($request->jenis_mutasi == 'masuk') {
            $barang->stok += $request->jumlah;
            $barang->tanggal_masuk = $request->tanggal;
        } else {
            $barang->stok -= $request->jumlah;
        }
        //Transfer tempat
        if ($request->jenis_mutasi == 'transfer') {
            if(!$request->lokasi_tujuan_id){
                return response()->json(['error' => 'Lokasi tujuan diperlukan untuk mutasi transfer'], 400);
            }
            $barang->lokasi_id = $request->lokasi_tujuan_id;
        } 
        $barang->save();

        return response()->json($mutasi,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mutasi = Mutasi::with(['barang','user','lokasiAsal','lokasiTujuan'])->find($id);
        if (!$mutasi) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Barang',
            'data' => $mutasi
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
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|string|in:masuk,keluar,transfer',
            'jumlah' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        // Look for mutasi based on ID
        $mutasi = Mutasi::find($id);
        if (!$mutasi) {
            return response()->json(['error' => 'Mutasi tidak ditemukan'], 404);
        }

        // Take related barang
        $barang = Barang::find($mutasi->barang_id);
        $lokasiAsal = $barang->lokasi_id;
        // Save previous stok used for counting stok
        $stokSebelum = $barang->stok;

        // If jenis_mutasi is 'keluar', make sure stok is sufficient
        if ($request->jenis_mutasi == 'keluar' && $request->jumlah > $stokSebelum) {
            return response()->json(['error' => 'Stok tidak mencukupi'], 400);
        }
        $userId = Auth::id();
        
        // Update stok barang
        if ($request->jenis_mutasi == 'masuk') {
            $barang->tanggal_masuk = $request->tanggal;
            $barang->stok += $request->jumlah;
        } else {
            // Untuk jenis 'Keluar', kurangi stok sesuai jumlah
            // For jenis_mutasi 'keluar', substract stok by jumlah_barang
            $barang->stok -= $request->jumlah;
        }
        //Transfer
        if ($request->jenis_mutasi == 'transfer') {
            // Mutasi Transfer -> Update lokasi_barang like lokasi_tujuan
            if (!$request->lokasi_tujuan_id) {
                return response()->json(['error' => 'Lokasi tujuan diperlukan untuk mutasi transfer'], 400);
            }
            
            // Update lokasi_barang like lokasi_tujuan
            $barang->lokasi_id = $request->lokasi_tujuan_id;
        }

        // Save changes from barang
        $barang->save();
        // Update mutasi
        $mutasi->update(array_merge($request->all(), ['user_id' => $userId,'lokasi_asal_id'=>$lokasiAsal]));
        
        return response()->json($mutasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Look for mutasi based on ID
        $mutasi = Mutasi::find($id);
        if (!$mutasi) {
            return response()->json(['error' => 'Mutasi tidak ditemukan'], 404);
        }

        // Take related barang
        $barang = Barang::find($mutasi->barang_id);
        
        // Update stok barang by jenis_mutasi deleted
        if ($mutasi->jenis_mutasi == 'masuk') {
            // Jika jenis mutasi 'Masuk', kurangi stok
            $barang->stok -= $mutasi->jumlah;
        } else {
            // Jika jenis mutasi 'Keluar', tambahkan kembali ke stok
            $barang->stok += $mutasi->jumlah;
        }

        // Simpan perubahan pada barang
        $barang->save();

        // Hapus mutasi
        $mutasi->delete();

        return response()->json(['message' => 'Mutasi berhasil dihapus']);
    }

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->bulan;
        $mutasis = Mutasi::whereMonth('tanggal', $bulan)->get();

        return response()->json($mutasis);
    }
    //history
    public function historyByBarang($id)
    {
        $mutasis = Mutasi::where('barang_id', $id)->get();
        return response()->json($mutasis);
    }

    public function historyByUser($id)
    {
        $mutasis = Mutasi::where('user_id', $id)->get();
        return response()->json($mutasis);
    }

    //gorupby keluar, masuk, transfer
    public function keluarGroup()
    {
        $mutasiKeluar = Mutasi::where("jenis_mutasi",'keluar')->get();
        return response()->json($mutasiKeluar);
    }
    public function masukGroup()
    {
        $mutasiMasuk = Mutasi::where("jenis_mutasi",'masuk')->get();
        return response()->json($mutasiMasuk);
    }
    public function transferGroup()
    {
        $mutasiTransfer = Mutasi::where("jenis_mutasi",'transfer')->get();
        return response()->json($mutasiTransfer);
    }
}
