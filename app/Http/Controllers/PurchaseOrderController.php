<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['brand', 'article', 'color', 'size'])->latest()->paginate(10);
        return view('pages.purchase-orders.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $articles = Article::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('pages.purchase-orders.create', compact('brands', 'articles', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'po_number' => 'required|string|max:255|unique:purchase_orders',
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'qty_ordered' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'status' => 'required|in:open,in_progress,completed',
            'notes' => 'nullable|string',
        ]);

        PurchaseOrder::create($validated);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('pages.purchase-orders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $brands = Brand::all();
        $articles = Article::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('pages.purchase-orders.edit', compact('purchaseOrder', 'brands', 'articles', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'po_number' => 'required|string|max:255|unique:purchase_orders,po_number,' . $purchaseOrder->id,
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'qty_ordered' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'status' => 'required|in:open,in_progress,completed',
            'notes' => 'nullable|string',
        ]);

        $purchaseOrder->update($validated);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil dihapus!');
    }
}
