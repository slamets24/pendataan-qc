<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SalesChannel;
use Illuminate\Http\Request;

class SalesChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesChannels = SalesChannel::with('brand')->latest()->paginate(10);
        return view('pages.sales-channels.index', compact('salesChannels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return view('pages.sales-channels.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ]);

        SalesChannel::create($validated);

        return redirect()->route('sales-channels.index')
            ->with('success', 'Sales Channel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesChannel $salesChannel)
    {
        return view('pages.sales-channels.show', compact('salesChannel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesChannel $salesChannel)
    {
        $brands = Brand::all();
        return view('pages.sales-channels.edit', compact('salesChannel', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesChannel $salesChannel)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ]);

        $salesChannel->update($validated);

        return redirect()->route('sales-channels.index')
            ->with('success', 'Sales Channel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesChannel $salesChannel)
    {
        $salesChannel->delete();

        return redirect()->route('sales-channels.index')
            ->with('success', 'Sales Channel berhasil dihapus!');
    }
}
