<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Purchase Order Baru') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <form action="{{ route('purchase-orders.store') }}" method="POST" x-data="poForm()">
                        @csrf

                        <!-- Auto-generated PO Number Preview -->
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <label class="block text-sm font-medium text-blue-900 dark:text-blue-200 mb-2">
                                Nomor PO (Otomatis)
                            </label>
                            <div class="text-lg font-mono font-semibold text-blue-700 dark:text-blue-300" x-text="poNumberPreview || 'Pilih Brand dan Tanggal'"></div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Format: Type/Brand/Tanggal-Seq</p>
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
                                        <option value="{{ $brand->id }}" data-type="{{ $brand->type }}" data-name="{{ $brand->name }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                                <input type="date" name="order_date" id="order_date" value="{{ old('order_date', date('Y-m-d')) }}"
                                       @change="updatePOPreview()"
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
                                <div x-show="!selectedBrand" class="text-sm text-gray-500 dark:text-gray-400 italic py-2">
                                    Pilih brand terlebih dahulu
                                </div>

                                <!-- Searchable Article Select -->
                                <div x-show="selectedBrand" class="relative">
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
                                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
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
                                        <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>{{ $size->code }}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qty_ordered" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="qty_ordered" id="qty_ordered" value="{{ old('qty_ordered') }}" min="1"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('qty_ordered')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
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
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function poForm() {
            return {
                selectedBrand: null,
                brandType: '',
                brandName: '',
                articles: [],
                loadingArticles: false,
                poNumberPreview: '',

                // Article Search
                articleSearch: '',
                selectedArticle: '',
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

                async onBrandChange(brandId) {
                    this.selectedBrand = brandId;

                    // Reset article selection
                    this.articleSearch = '';
                    this.selectedArticle = '';
                    this.articles = [];

                    if (!brandId) {
                        this.brandType = '';
                        this.brandName = '';
                        this.poNumberPreview = '';
                        return;
                    }

                    // Get brand data from option
                    const option = document.querySelector(`#brand_id option[value="${brandId}"]`);
                    this.brandType = option.dataset.type;
                    this.brandName = option.dataset.name;

                    // Update PO preview
                    this.updatePOPreview();

                    // Load articles
                    this.loadingArticles = true;
                    try {
                        const response = await fetch(`/api/articles/brand/${brandId}`);
                        this.articles = await response.json();
                    } catch (error) {
                        console.error('Error loading articles:', error);
                    }
                    this.loadingArticles = false;
                },

                updatePOPreview() {
                    if (!this.selectedBrand || !document.getElementById('order_date').value) {
                        this.poNumberPreview = '';
                        return;
                    }

                    const typeMap = {
                        'po': 'PO',
                        'reseller': 'RL',
                        'store_stock': 'SS',
                        'makloon': 'MK'
                    };
                    const type = typeMap[this.brandType] || 'PO';
                    const brandAbbr = this.brandName.replace(/\s/g, '').substring(0, 3).toUpperCase();
                    const dateVal = document.getElementById('order_date').value;
                    const dateParts = dateVal.split('-'); // YYYY-MM-DD
                    const dateFormatted = dateParts[0].substring(2) + dateParts[1] + dateParts[2]; // YYMMDD

                    this.poNumberPreview = `${type}/${brandAbbr}/${dateFormatted}-001`;
                }
            }
        }
    </script>
</x-app-layout>
