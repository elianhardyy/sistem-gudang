<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->foreignId('lokasi_asal_id')->nullable()->constrained('lokasis')->onDelete('set null'); // Lokasi asal
            $table->foreignId('lokasi_tujuan_id')->nullable()->constrained('lokasis')->onDelete('set null');
            $table->date('tanggal');
            $table->enum('jenis_mutasi',['masuk','keluar','transfer']);  // Masuk, Keluar
            $table->integer('jumlah');
            $table->text('keterangan')->nullable(); // Keterangan atau catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
