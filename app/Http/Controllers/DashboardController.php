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
    public function index(Request $request)
    {
        // Get filter parameter (default: 'all')
        $filter = $request->get('filter', 'all');

        // Calculate date range based on filter
        $dateFrom = $this->getDateFromFilter($filter);

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
        $outgoingByStatusQuery = OutgoingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $outgoingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $outgoingByStatus = $outgoingByStatusQuery->groupBy('status')->get();

        // Recent Outgoing Goods
        $recentOutgoing = OutgoingGoods::with(['brand', 'article', 'color', 'size'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Incoming Goods by Status
        $incomingByStatusQuery = IncomingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $incomingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $incomingByStatus = $incomingByStatusQuery->groupBy('status')->get();

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

        // QC Process Summary - grouped by process type with custom order
        $qcByProcessQuery = QCSummary::select('process', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $qcByProcessQuery->where('date', '>=', $dateFrom);
        }
        $qcByProcess = $this->sortQCProcessByCustomOrder($qcByProcessQuery->groupBy('process')->get());

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

    private function getDateFromFilter($filter)
    {
        return match($filter) {
            'today' => now()->startOfDay(),
            '3days' => now()->subDays(3)->startOfDay(),
            '1week' => now()->subWeek()->startOfDay(),
            '1month' => now()->subMonth()->startOfDay(),
            '1year' => now()->subYear()->startOfDay(),
            default => null, // 'all'
        };
    }

    private function sortQCProcessByCustomOrder($qcByProcess)
    {
        // Custom order: Gantungan, Buang Benang, Kancing, Plat, Steam
        // hanging, thread_trimming, buttoning, plating, steaming
        $processOrder = ['hanging', 'thread_trimming', 'buttoning', 'plating', 'steaming'];

        return $qcByProcess->sortBy(function($item) use ($processOrder) {
            $index = array_search($item->process, $processOrder);
            return $index !== false ? $index : 999;
        })->values();
    }

    public function getChartData(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $dateFrom = $this->getDateFromFilter($filter);

        // QC Process Summary with custom order
        $qcByProcessQuery = QCSummary::select('process', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $qcByProcessQuery->where('date', '>=', $dateFrom);
        }
        $qcByProcess = $this->sortQCProcessByCustomOrder($qcByProcessQuery->groupBy('process')->get());

        // Incoming Goods by Status
        $incomingByStatusQuery = IncomingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $incomingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $incomingByStatus = $incomingByStatusQuery->groupBy('status')->get();

        // Outgoing Goods by Status
        $outgoingByStatusQuery = OutgoingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $outgoingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $outgoingByStatus = $outgoingByStatusQuery->groupBy('status')->get();

        return response()->json([
            'qcByProcess' => $qcByProcess,
            'incomingByStatus' => $incomingByStatus,
            'outgoingByStatus' => $outgoingByStatus,
        ]);
    }

    public function welcome(Request $request)
    {
        // Get filter parameter (default: 'today' for public page)
        $filter = $request->get('filter', 'today');

        // Calculate date range based on filter
        $dateFrom = $this->getDateFromFilter($filter);

        // Total Statistics (for today or filtered period)
        $totalIncomingGoodsQuery = IncomingGoods::query();
        $totalOutgoingGoodsQuery = OutgoingGoods::query();
        $totalQCProcessedQuery = QCSummary::query();

        if ($dateFrom) {
            $totalIncomingGoodsQuery->where('date', '>=', $dateFrom);
            $totalOutgoingGoodsQuery->where('date', '>=', $dateFrom);
            $totalQCProcessedQuery->where('date', '>=', $dateFrom);
        }

        $totalIncomingGoods = $totalIncomingGoodsQuery->sum('qty');
        $totalOutgoingGoods = $totalOutgoingGoodsQuery->sum('qty');
        $totalQCProcessed = $totalQCProcessedQuery->sum('qty');

        // QC Process Summary - grouped by process type with custom order
        $qcByProcessQuery = QCSummary::select('process', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $qcByProcessQuery->where('date', '>=', $dateFrom);
        }
        $qcByProcess = $this->sortQCProcessByCustomOrder($qcByProcessQuery->groupBy('process')->get());

        // Incoming Goods by Status
        $incomingByStatusQuery = IncomingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $incomingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $incomingByStatus = $incomingByStatusQuery->groupBy('status')->get();

        // Outgoing Goods by Status
        $outgoingByStatusQuery = OutgoingGoods::select('status', DB::raw('sum(qty) as total'));
        if ($dateFrom) {
            $outgoingByStatusQuery->where('date', '>=', $dateFrom);
        }
        $outgoingByStatus = $outgoingByStatusQuery->groupBy('status')->get();

        return view('welcome', compact(
            'totalIncomingGoods',
            'totalOutgoingGoods',
            'totalQCProcessed',
            'incomingByStatus',
            'outgoingByStatus',
            'qcByProcess'
        ));
    }
}
