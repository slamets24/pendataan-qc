<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingGoodsController;
use App\Http\Controllers\OutgoingGoodsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\QCSummaryController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\SalesChannelController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Data Routes
    Route::resource('brands', BrandController::class);
    Route::resource('articles', ArticleController::class);
    Route::get('api/articles/brand/{brandId}', [ArticleController::class, 'getByBrand'])->name('articles.by-brand');
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('sales-channels', SalesChannelController::class);
    Route::resource('purchase-orders', PurchaseOrderController::class);

    // Transaction Routes
    Route::resource('incoming-goods', IncomingGoodsController::class);
    Route::resource('qc-summary', QCSummaryController::class);
    Route::resource('revisions', RevisionController::class);
    Route::resource('outgoing-goods', OutgoingGoodsController::class);
});

require __DIR__.'/auth.php';
