<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode_barang' => 'nullable|string|max:255|unique:items,kode_barang,' . ($this->route('item') ? $this->route('item')->id : ''),
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'lokasi_rak' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ];
    }
}
