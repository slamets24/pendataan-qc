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
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'qty_ordered' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Generate PO Number: type_pengiriman/brand/tanggal
        $brand = Brand::find($validated['brand_id']);
        $date = date('ymd', strtotime($validated['order_date'])); // Format: YYMMDD

        // Determine type based on brand type
        $typeMap = [
            'po' => 'PO',
            'reseller' => 'RL',
            'store_stock' => 'SS',
            'makloon' => 'MK',
        ];
        $type = $typeMap[$brand->type] ?? 'PO';

        // Get brand abbreviation (first 3 letters uppercase)
        $brandAbbr = strtoupper(substr(str_replace(' ', '', $brand->name), 0, 3));

        // Find the next sequence number for today
        $prefix = $type . '/' . $brandAbbr . '/' . $date;
        $lastPO = PurchaseOrder::where('po_number', 'LIKE', $prefix . '%')
            ->orderBy('po_number', 'desc')
            ->first();

        if ($lastPO) {
            // Extract sequence number and increment
            $lastSeq = intval(substr($lastPO->po_number, -3));
            $seq = str_pad($lastSeq + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $seq = '001';
        }

        $validated['po_number'] = $prefix . '-' . $seq;

        PurchaseOrder::create($validated);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil ditambahkan dengan nomor: ' . $validated['po_number']);
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
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'qty_ordered' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // PO Number tidak diubah saat update
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
