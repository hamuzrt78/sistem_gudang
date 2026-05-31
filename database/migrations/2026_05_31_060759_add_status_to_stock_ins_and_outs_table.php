<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->enum('status', ['pending_superadmin', 'pending_pimpinan', 'approved', 'rejected'])
                  ->default('pending_superadmin')
                  ->after('keterangan');
        });

        Schema::table('stock_outs', function (Blueprint $table) {
            $table->enum('status', ['pending_superadmin', 'pending_pimpinan', 'approved', 'rejected'])
                  ->default('pending_superadmin')
                  ->after('keterangan');
        });

        // Set existing records to approved so the system continues normally
        DB::table('stock_ins')->update(['status' => 'approved']);
        DB::table('stock_outs')->update(['status' => 'approved']);
    }

    public function down(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('stock_outs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

