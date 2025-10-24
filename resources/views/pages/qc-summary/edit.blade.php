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

        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <form action="{{ route('qc-summary.update', $qcSummary) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Brand <span class="text-red-500">*</span>
                            </label>
                            <select name="brand_id" id="brand_id"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">Pilih Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $qcSummary->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="article_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Artikel <span class="text-red-500">*</span>
                            </label>
                            <select name="article_id" id="article_id"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">Pilih Artikel</option>
                                @foreach($articles as $article)
                                    <option value="{{ $article->id }}" {{ old('article_id', $qcSummary->article_id) == $article->id ? 'selected' : '' }}>{{ $article->name }}</option>
                                @endforeach
                            </select>
                            @error('article_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
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

                        <div class="mb-6">
                            <label for="process" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Proses <span class="text-red-500">*</span>
                            </label>
                            <select name="process" id="process"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">Pilih Proses</option>
                                <option value="hanging" {{ old('process', $qcSummary->process) == 'hanging' ? 'selected' : '' }}>Hanging</option>
                                <option value="buttoning" {{ old('process', $qcSummary->process) == 'buttoning' ? 'selected' : '' }}>Buttoning</option>
                                <option value="plating" {{ old('process', $qcSummary->process) == 'plating' ? 'selected' : '' }}>Plating</option>
                                <option value="steaming" {{ old('process', $qcSummary->process) == 'steaming' ? 'selected' : '' }}>Steaming</option>
                                <option value="thread_trimming" {{ old('process', $qcSummary->process) == 'thread_trimming' ? 'selected' : '' }}>Thread Trimming</option>
                            </select>
                            @error('process')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
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

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $qcSummary->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
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
</x-app-layout>

