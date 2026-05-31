<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        $unitId = $this->route('unit') ? $this->route('unit')->id : null;

        return [
            'nama_satuan' => 'required|string|max:100|unique:units,nama_satuan,' . $unitId,
            'simbol' => 'required|string|max:10|unique:units,simbol,' . $unitId,
        ];
    }
}
