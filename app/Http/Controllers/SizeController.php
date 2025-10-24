<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $sizes = Size::latest()->paginate($perPage);
        return view('pages.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50',
            'category' => 'required|string|max:255',
        ]);

        Size::create($validated);

        return redirect()->route('sizes.index')
            ->with('success', 'Ukuran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return view('pages.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('pages.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50',
            'category' => 'required|string|max:255',
        ]);

        $size->update($validated);

        return redirect()->route('sizes.index')
            ->with('success', 'Ukuran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('sizes.index')
            ->with('success', 'Ukuran berhasil dihapus!');
    }
}
