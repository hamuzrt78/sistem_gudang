<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('nama_satuan')->paginate(10);
        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_satuan' => 'required|string|max:255',
            'simbol' => 'nullable|string|max:50',
        ]);

        Unit::create($data);
        return redirect()->route('units.index')->with('success', 'Satuan berhasil ditambahkan.');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'nama_satuan' => 'required|string|max:255',
            'simbol' => 'nullable|string|max:50',
        ]);

        $unit->update($data);
        return redirect()->route('units.index')->with('success', 'Satuan berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Satuan berhasil dihapus.');
    }
}
