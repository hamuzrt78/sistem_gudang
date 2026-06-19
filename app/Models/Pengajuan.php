<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'kode_pengajuan',
        'tipe',
        'user_id',
        'status',
        'tanggal',
        'supplier_tujuan',
        'keterangan_umum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }
}
