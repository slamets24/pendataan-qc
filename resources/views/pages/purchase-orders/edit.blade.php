<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Purchase Order') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Purchase Order', 'url' => route('purchase-orders.index')],
            ['label' => 'Edit Purchase Order']
        ]" />

        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST" x-data="poEditForm({{ $purchaseOrder->brand_id }})">
                        @csrf
                        @method('PUT')

                        <!-- Display PO Number (readonly) -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900/20 rounded-lg border border-gray-200 dark:border-gray-700">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nomor PO (Tidak dapat diubah)
                            </label>
                            <div class="text-lg font-mono font-semibold text-gray-900 dark:text-gray-100">
                                {{ $purchaseOrder->po_number }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Brand <span class="text-red-500">*</span>
                                </label>
                                <select name="brand_id" id="brand_id" @change="onBrandChange($event.target.value)"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $purchaseOrder->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }} ({{ ucfirst($brand->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="order_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Order <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="order_date" id="order_date"
                                       value="{{ old('order_date', $purchaseOrder->order_date ? $purchaseOrder->order_date->format('Y-m-d') : '') }}"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('order_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Artikel <span class="text-red-500">*</span>
                                </label>

                                <!-- Searchable Article Select -->
                                <div class="relative">
                                    <!-- Search Input -->
                                    <input type="text"
                                           x-model="articleSearch"
                                           @click="showArticleDropdown = true"
                                           @input="showArticleDropdown = true"
                                           placeholder="Ketik untuk mencari artikel..."
                                           class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                           autocomplete="off">

                                    <!-- Hidden Input for Form Submission -->
                                    <input type="hidden" name="article_id" id="article_id" x-model="selectedArticle" required>

                                    <!-- Dropdown List -->
                                    <div x-show="showArticleDropdown && filteredArticles.length > 0"
                                         @click.away="showArticleDropdown = false"
                                         class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg max-h-60 overflow-auto">
                                        <template x-for="article in filteredArticles" :key="article.id">
                                            <div @click="selectArticle(article)"
                                                 class="px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-900 cursor-pointer"
                                                 :class="{'bg-blue-50 dark:bg-blue-900/30': selectedArticle == article.id}">
                                                <div class="font-medium text-gray-900 dark:text-gray-100" x-text="article.article_name"></div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400" x-text="article.category"></div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- No Results -->
                                    <div x-show="showArticleDropdown && articleSearch && filteredArticles.length === 0"
                                         class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg p-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada artikel yang cocok
                                    </div>
                                </div>

                                <div x-show="loadingArticles" class="text-sm text-gray-500 mt-1">Loading artikel...</div>
                                @error('article_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="color_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Warna <span class="text-red-500">*</span>
                                </label>
                                <select name="color_id" id="color_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Warna</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" {{ old('color_id', $purchaseOrder->color_id) == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="size_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ukuran <span class="text-red-500">*</span>
                                </label>
                                <select name="size_id" id="size_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}" {{ old('size_id', $purchaseOrder->size_id) == $size->id ? 'selected' : '' }}>{{ $size->code }}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qty_ordered" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity Ordered <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="qty_ordered" id="qty_ordered" value="{{ old('qty_ordered', $purchaseOrder->qty_ordered) }}" min="1"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('qty_ordered')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Progress PO
                                </label>
                                <div class="p-4 bg-gray-50 dark:bg-gray-900/20 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Dikirim ke Packing</span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                            {{ number_format($purchaseOrder->qty_sent) }} / {{ number_format($purchaseOrder->qty_ordered) }} pcs
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                                             style="width: {{ min($purchaseOrder->progress, 100) }}%"></div>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $purchaseOrder->progress }}% Complete</span>
                                        @if($purchaseOrder->auto_status == 'completed')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Completed
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                In Progress
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $purchaseOrder->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('purchase-orders.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function poEditForm(initialBrandId) {
            return {
                selectedBrand: initialBrandId,
                articles: [],
                loadingArticles: false,

                // Article Search
                articleSearch: '',
                selectedArticle: {{ $purchaseOrder->article_id }},
                showArticleDropdown: false,

                get filteredArticles() {
                    if (!this.articleSearch) {
                        return this.articles;
                    }
                    const search = this.articleSearch.toLowerCase();
                    return this.articles.filter(article =>
                        article.article_name.toLowerCase().includes(search) ||
                        article.category.toLowerCase().includes(search)
                    );
                },

                selectArticle(article) {
                    this.selectedArticle = article.id;
                    this.articleSearch = `${article.article_name} (${article.category})`;
                    this.showArticleDropdown = false;
                },

                init() {
                    // Load articles for initial brand
                    if (this.selectedBrand) {
                        this.loadArticles(this.selectedBrand);
                    }
                },

                async onBrandChange(brandId) {
                    this.selectedBrand = brandId;

                    // Reset article selection
                    this.articleSearch = '';
                    this.selectedArticle = '';
                    this.articles = [];

                    if (!brandId) {
                        return;
                    }
                    await this.loadArticles(brandId);
                },

                async loadArticles(brandId) {
                    this.loadingArticles = true;
                    try {
                        const response = await fetch(`/api/articles/brand/${brandId}`);
                        this.articles = await response.json();

                        // Set initial article text if editing
                        if (this.selectedArticle && !this.articleSearch) {
                            const currentArticle = this.articles.find(a => a.id == this.selectedArticle);
                            if (currentArticle) {
                                this.articleSearch = `${currentArticle.article_name} (${currentArticle.category})`;
                            }
                        }
                    } catch (error) {
                        console.error('Error loading articles:', error);
                    }
                    this.loadingArticles = false;
                }
            }
        }
    </script>
</x-app-layout>
