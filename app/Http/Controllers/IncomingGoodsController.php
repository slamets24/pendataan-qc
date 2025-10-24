<?php

namespace App\Http\Controllers;

use App\Models\IncomingGoods;
use App\Models\Brand;
use App\Models\Article;
use App\Models\Color;
use App\Models\Size;
use App\Models\PurchaseOrder;
use App\Models\SalesChannel;
use Illuminate\Http\Request;

class IncomingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $incomingGoods = IncomingGoods::with(['brand', 'article', 'color', 'size', 'purchaseOrder', 'salesChannel'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.incoming-goods.index', compact('incomingGoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::with('brand')->orderBy('article_name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $purchaseOrders = PurchaseOrder::with(['brand', 'article', 'color', 'size'])
            ->orderBy('po_number')
            ->get()
            ->filter(function($po) {
                // Hanya tampilkan PO yang belum 100% complete (masih ada sisa qty)
                return $po->qty_remaining > 0;
            })
            ->values(); // Re-index untuk jadi array proper
        $salesChannels = SalesChannel::orderBy('name')->get();

        // Prepare PO data for auto-fill
        $purchaseOrdersData = $purchaseOrders->map(function($po) {
            return [
                'id' => $po->id,
                'brand_id' => $po->brand_id,
                'article_id' => $po->article_id,
                'color_id' => $po->color_id,
                'size_id' => $po->size_id,
            ];
        })->values(); // Re-index untuk jadi array proper

        return view('pages.incoming-goods.create', compact('brands', 'articles', 'colors', 'sizes', 'purchaseOrders', 'salesChannels', 'purchaseOrdersData'));
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
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'po_id' => 'nullable|exists:purchase_orders,id',
            'sales_channel_id' => 'nullable|exists:sales_channels,id',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        // Status akan otomatis 'received' dari database default

        IncomingGoods::create($validated);

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Data barang masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingGoods $incomingGood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomingGoods $incomingGood)
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::with('brand')->orderBy('article_name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $purchaseOrders = PurchaseOrder::with(['brand', 'article', 'color', 'size'])
            ->orderBy('po_number')
            ->get()
            ->filter(function($po) {
                // Hanya tampilkan PO yang belum 100% complete (masih ada sisa qty)
                return $po->qty_remaining > 0;
            })
            ->values(); // Re-index untuk jadi array proper
        $salesChannels = SalesChannel::orderBy('name')->get();

        // Prepare PO data for auto-fill
        $purchaseOrdersData = $purchaseOrders->map(function($po) {
            return [
                'id' => $po->id,
                'brand_id' => $po->brand_id,
                'article_id' => $po->article_id,
                'color_id' => $po->color_id,
                'size_id' => $po->size_id,
            ];
        })->values(); // Re-index untuk jadi array proper

        return view('pages.incoming-goods.edit', compact('incomingGood', 'brands', 'articles', 'colors', 'sizes', 'purchaseOrders', 'salesChannels', 'purchaseOrdersData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomingGoods $incomingGood)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'po_id' => 'nullable|exists:purchase_orders,id',
            'sales_channel_id' => 'nullable|exists:sales_channels,id',
            'notes' => 'nullable|string',
        ]);

        // Status tidak diupdate dari form, akan dikelola oleh sistem
        $incomingGood->update($validated);

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Data barang masuk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingGoods $incomingGood)
    {
        $incomingGood->delete();

        return redirect()->route('incoming-goods.index')
            ->with('success', 'Data barang masuk berhasil dihapus');
    }
}
