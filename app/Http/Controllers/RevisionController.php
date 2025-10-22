<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use App\Models\Brand;
use App\Models\Article;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revisions = Revision::with(['brand', 'article', 'color', 'size'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.revisions.index', compact('revisions'));
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

        return view('pages.revisions.create', compact('brands', 'articles', 'colors', 'sizes'));
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
            'date' => 'required|date',
            'tailor_code' => 'required|string|max:255',
            'qc_code' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        Revision::create($validated);

        return redirect()->route('revisions.index')
            ->with('success', 'Data revisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Revision $revision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revision $revision)
    {
        $brands = Brand::orderBy('name')->get();
        $articles = Article::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();

        return view('pages.revisions.edit', compact('revision', 'brands', 'articles', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revision $revision)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_id' => 'required|exists:articles,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'date' => 'required|date',
            'tailor_code' => 'required|string|max:255',
            'qc_code' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $revision->update($validated);

        return redirect()->route('revisions.index')
            ->with('success', 'Data revisi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revision $revision)
    {
        $revision->delete();

        return redirect()->route('revisions.index')
            ->with('success', 'Data revisi berhasil dihapus');
    }
}
