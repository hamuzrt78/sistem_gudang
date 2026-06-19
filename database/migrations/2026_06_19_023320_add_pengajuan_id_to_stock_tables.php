<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuans')->cascadeOnDelete()->after('id');
        });

        Schema::table('stock_outs', function (Blueprint $table) {
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuans')->cascadeOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->dropForeign(['pengajuan_id']);
            $table->dropColumn('pengajuan_id');
        });

        Schema::table('stock_outs', function (Blueprint $table) {
            $table->dropForeign(['pengajuan_id']);
            $table->dropColumn('pengajuan_id');
        });
    }
};
