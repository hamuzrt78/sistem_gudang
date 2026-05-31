<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['category', 'unit'])->orderBy('nama_barang');
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('category_id', $request->kategori);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        $items = $query->paginate(10)->appends($request->query());
        $categories = Category::orderBy('nama_kategori')->get();

        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama_kategori')->get();
        $units = Unit::orderBy('nama_satuan')->get();
        return view('items.create', compact('categories', 'units'));
    }

    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        Item::create($data);
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('nama_kategori')->get();
        $units = Unit::orderBy('nama_satuan')->get();
        return view('items.edit', compact('item', 'categories', 'units'));
    }

    public function update(ItemRequest $request, Item $item)
    {
        $data = $request->validated();
        $item->update($data);
        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
