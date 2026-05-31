<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        return [
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }
}
