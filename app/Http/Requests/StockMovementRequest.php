<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockMovementRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        return [
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ];
    }
}
