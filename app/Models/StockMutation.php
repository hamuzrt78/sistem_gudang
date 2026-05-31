<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutation extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'tipe_mutasi', 'jumlah', 'stok_sebelum', 'stok_sesudah', 'referensi', 'created_by'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
