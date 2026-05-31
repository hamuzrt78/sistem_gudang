<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga', 'category_id', 'unit_id', 
        'stok', 'stok_minimum', 'lokasi_rak', 'deskripsi'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            if (!$item->kode_barang) {
                $lastItem = self::orderBy('id', 'desc')->first();
                $lastId = $lastItem ? $lastItem->id : 0;
                $item->kode_barang = 'BRG-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }

    public function stockMutations()
    {
        return $this->hasMany(StockMutation::class);
    }
}
