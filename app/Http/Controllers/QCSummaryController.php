<?php

namespace App\Http\Controllers;

use App\Models\QCSummary;
use App\Models\Brand;
use App\Models\Article;
use Illuminate\Http\Request;

class QCSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $qcSummaries = QCSummary::with(['brand', 'article'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.qc-summary.index', compact('qcSummaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::with('brand')->orderBy('article_name')->get()->map(function($article) {
            return [
                'id' => $article->id,
                'name' => $article->article_name,
                'brand_id' => $article->brand_id,
                'brand_name' => $article->brand->name ?? ''
            ];
        });

        return view('pages.qc-summary.create', compact('brands', 'articles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'date' => 'required|date',
            'process' => 'required|in:hanging,buttoning,plating,steaming,thread_trimming',
            'qty' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        QCSummary::create($validated);

        return redirect()->route('qc-summary.index')
            ->with('success', 'Data QC berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(QCSummary $qcSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QCSummary $qcSummary)
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::with('brand')->orderBy('article_name')->get()->map(function($article) {
            return [
                'id' => $article->id,
                'name' => $article->article_name,
                'brand_id' => $article->brand_id,
                'brand_name' => $article->brand->name ?? ''
            ];
        });

        return view('pages.qc-summary.edit', compact('qcSummary', 'brands', 'articles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QCSummary $qcSummary)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'date' => 'required|date',
            'process' => 'required|in:hanging,buttoning,plating,steaming,thread_trimming',
            'qty' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $qcSummary->update($validated);

        return redirect()->route('qc-summary.index')
            ->with('success', 'Data QC berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QCSummary $qcSummary)
    {
        $qcSummary->delete();

        return redirect()->route('qc-summary.index')
            ->with('success', 'Data QC berhasil dihapus');
    }
}
