<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->enum('tipe', ['in', 'out']);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['pending_superadmin', 'pending_pimpinan', 'approved', 'rejected'])->default('pending_superadmin');
            $table->date('tanggal');
            $table->string('supplier_tujuan')->nullable();
            $table->text('keterangan_umum')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
