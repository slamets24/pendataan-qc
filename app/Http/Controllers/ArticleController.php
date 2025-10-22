<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('brand')->latest()->paginate(10);
        return view('pages.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('pages.articles.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'created_date' => 'required|date',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('pages.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $brands = Brand::orderBy('name')->get();
        return view('pages.articles.edit', compact('article', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'created_date' => 'required|date',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Get articles by brand (for AJAX)
     */
    public function getByBrand($brandId)
    {
        $articles = Article::where('brand_id', $brandId)
            ->orderBy('article_name')
            ->get(['id', 'article_name', 'category']);

        return response()->json($articles);
    }
}
