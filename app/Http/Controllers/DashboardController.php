<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Color;
use App\Models\IncomingGoods;
use App\Models\OutgoingGoods;
use App\Models\PurchaseOrder;
use App\Models\QCSummary;
use App\Models\Revision;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics
        $totalBrands = Brand::count();
        $totalArticles = Article::count();
        $totalIncomingGoods = IncomingGoods::sum('qty');
        $totalOutgoingGoods = OutgoingGoods::sum('qty');
        $totalRevisions = Revision::sum('qty');
        $totalQCProcessed = QCSummary::sum('qty');
        $totalPurchaseOrders = PurchaseOrder::count();

        // Brand Statistics
        $brandStats = Brand::withSum('incomingGoods', 'qty')
            ->withSum('outgoingGoods', 'qty')
            ->withSum('revisions', 'qty')
            ->withCount('purchaseOrders')
            ->get();

        // Outgoing Goods by Status
        $outgoingByStatus = OutgoingGoods::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Recent Outgoing Goods
        $recentOutgoing = OutgoingGoods::with(['brand', 'article', 'color', 'size'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Incoming Goods by Status
        $incomingByStatus = IncomingGoods::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Recent Incoming Goods
        $recentIncoming = IncomingGoods::with(['brand', 'article', 'color', 'size', 'purchaseOrder', 'salesChannel'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Recent Revisions
        $recentRevisions = Revision::with(['brand', 'article', 'color', 'size'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // QC Process Summary - grouped by process type
        $qcByProcess = QCSummary::select('process', DB::raw('sum(qty) as total'))
            ->groupBy('process')
            ->get();

        // Top Articles by Incoming Quantity
        $topArticles = Article::withSum('incomingGoods', 'qty')
            ->orderBy('incoming_goods_sum_qty', 'desc')
            ->limit(5)
            ->get();

        // Articles with Most Revisions
        $articlesWithRevisions = Article::withCount('revisions')
            ->withSum('revisions', 'qty')
            ->whereHas('revisions')
            ->orderBy('revisions_sum_qty', 'desc')
            ->limit(5)
            ->get();

        // Monthly Trend - Incoming Goods (Last 6 months)
        $monthlyIncoming = IncomingGoods::select(
            DB::raw("strftime('%Y-%m', date) as month"),
            DB::raw('sum(qty) as total')
        )
            ->where('date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Daily QC Summary (Last 7 days)
        $dailyQC = QCSummary::select(
            'date',
            DB::raw('sum(qty) as total')
        )
            ->where('date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalBrands',
            'totalArticles',
            'totalIncomingGoods',
            'totalOutgoingGoods',
            'totalRevisions',
            'totalQCProcessed',
            'totalPurchaseOrders',
            'brandStats',
            'incomingByStatus',
            'outgoingByStatus',
            'recentIncoming',
            'recentOutgoing',
            'recentRevisions',
            'qcByProcess',
            'topArticles',
            'articlesWithRevisions',
            'monthlyIncoming',
            'dailyQC'
        ));
    }
}
