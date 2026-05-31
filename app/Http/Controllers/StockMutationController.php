<?php

namespace App\Http\Controllers;

use App\Models\StockMutation;

class StockMutationController extends Controller
{
    public function index()
    {
        $mutations = StockMutation::with('item', 'user')->latest()->paginate(20);
        return view('mutations.index', compact('mutations'));
    }
}
