<?php

namespace App\Http\Controllers;

use App\Models\OutgoingGoods;
use App\Models\Brand;
use App\Models\Article;
use App\Models\Color;
use App\Models\Size;
use App\Models\IncomingGoods;
use Illuminate\Http\Request;

class OutgoingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outgoingGoods = OutgoingGoods::with(['brand', 'article', 'color', 'size', 'incomingGoods', 'createdBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.outgoing-goods.index', compact('outgoingGoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $incomingGoods = IncomingGoods::with(['brand', 'article', 'color', 'size'])
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.outgoing-goods.create', compact('brands', 'articles', 'colors', 'sizes', 'incomingGoods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'incoming_id' => 'nullable|exists:incoming_goods,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'status' => 'required|in:sent_to_packing,returned_to_qc,cancelled',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        OutgoingGoods::create($validated);

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Data kirim packing berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingGoods $outgoingGood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OutgoingGoods $outgoingGood)
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $incomingGoods = IncomingGoods::with(['brand', 'article', 'color', 'size'])
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.outgoing-goods.edit', compact('outgoingGood', 'brands', 'articles', 'colors', 'sizes', 'incomingGoods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutgoingGoods $outgoingGood)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'incoming_id' => 'nullable|exists:incoming_goods,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'status' => 'required|in:sent_to_packing,returned_to_qc,cancelled',
            'notes' => 'nullable|string',
        ]);

        $outgoingGood->update($validated);

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Data kirim packing berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingGoods $outgoingGood)
    {
        $outgoingGood->delete();

        return redirect()->route('outgoing-goods.index')
            ->with('success', 'Data kirim packing berhasil dihapus');
    }
}
