<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Proses QC') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Proses QC', 'url' => route('qc-summary.index')],
            ['label' => 'Edit Proses QC']
        ]" />

        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <form action="{{ route('qc-summary.update', $qcSummary) }}" method="POST" x-data="qcForm()">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                                <div class="font-medium text-gray-900 dark:text-gray-100" x-text="article.name"></div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400" x-text="article.brand_name"></div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- No Results -->
                                    <div x-show="showArticleDropdown && articleSearch && filteredArticles.length === 0"
                                         class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg p-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada artikel yang cocok
                                    </div>
                                </div>

                                @error('article_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Brand <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       x-model="selectedBrandName"
                                       readonly
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 shadow-sm bg-gray-100 cursor-not-allowed"
                                       placeholder="Otomatis terisi">
                                <input type="hidden" name="brand_id" id="brand_id" x-model="selectedBrand" required>
                                @error('brand_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" id="date" value="{{ old('date', $qcSummary->date ? $qcSummary->date->format('Y-m-d') : '') }}"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="process" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Proses <span class="text-red-500">*</span>
                                </label>
                                <select name="process" id="process"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Proses</option>
                                    <option value="hanging" {{ old('process', $qcSummary->process) == 'hanging' ? 'selected' : '' }}>Gantungan</option>
                                    <option value="thread_trimming" {{ old('process', $qcSummary->process) == 'thread_trimming' ? 'selected' : '' }}>Buang Benang</option>
                                    <option value="buttoning" {{ old('process', $qcSummary->process) == 'buttoning' ? 'selected' : '' }}>Kancing</option>
                                    <option value="plating" {{ old('process', $qcSummary->process) == 'plating' ? 'selected' : '' }}>Plat</option>
                                    <option value="steaming" {{ old('process', $qcSummary->process) == 'steaming' ? 'selected' : '' }}>Steam</option>
                                </select>
                                @error('process')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="qty" id="qty" value="{{ old('qty', $qcSummary->qty) }}" min="1"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('qty')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $qcSummary->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('qc-summary.index') }}"
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
        function qcForm() {
            return {
                articles: @json($articles),
                articleSearch: '',
                showArticleDropdown: false,
                selectedArticle: '{{ old('article_id', $qcSummary->article_id) }}',
                selectedBrand: '{{ old('brand_id', $qcSummary->brand_id) }}',
                selectedBrandName: '',

                get filteredArticles() {
                    if (!this.articleSearch) return this.articles;
                    const search = this.articleSearch.toLowerCase();
                    return this.articles.filter(article =>
                        article.name.toLowerCase().includes(search) ||
                        article.brand_name.toLowerCase().includes(search)
                    );
                },

                selectArticle(article) {
                    this.selectedArticle = article.id;
                    this.selectedBrand = article.brand_id;
                    this.selectedBrandName = article.brand_name;
                    this.articleSearch = article.name;
                    this.showArticleDropdown = false;
                },

                init() {
                    // Set initial values from existing data
                    if (this.selectedArticle) {
                        const article = this.articles.find(a => a.id == this.selectedArticle);
                        if (article) {
                            this.articleSearch = article.name;
                            this.selectedBrandName = article.brand_name;
                        }
                    }
                }
            }
        }
    </script>
</x-app-layout>
