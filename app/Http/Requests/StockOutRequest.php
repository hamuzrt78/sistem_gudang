<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ];
    }
}
