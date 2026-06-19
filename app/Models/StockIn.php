<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;
    protected $fillable = ['pengajuan_id', 'item_id', 'jumlah', 'tanggal_masuk', 'supplier', 'keterangan', 'user_id', 'status'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
