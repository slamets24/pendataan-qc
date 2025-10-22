<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang Masuk') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <form action="{{ route('incoming-goods.update', $incomingGood) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Brand <span class="text-red-500">*</span>
                                </label>
                                <select name="brand_id" id="brand_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $incomingGood->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="article_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Artikel <span class="text-red-500">*</span>
                                </label>
                                <select name="article_id" id="article_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Pilih Artikel</option>
                                    @foreach($articles as $article)
                                        <option value="{{ $article->id }}" {{ old('article_id', $incomingGood->article_id) == $article->id ? 'selected' : '' }}>{{ $article->name }}</option>
                                    @endforeach
                                </select>
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
                                        <option value="{{ $color->id }}" {{ old('color_id', $incomingGood->color_id) == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
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
                                        <option value="{{ $size->id }}" {{ old('size_id', $incomingGood->size_id) == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="qty" id="qty" value="{{ old('qty', $incomingGood->qty) }}" min="1"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('qty')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" id="date" value="{{ old('date', $incomingGood->date ? $incomingGood->date->format('Y-m-d') : '') }}"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('date')
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
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status', $incomingGood->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="received" {{ old('status', $incomingGood->status) == 'received' ? 'selected' : '' }}>Diterima</option>
                                    <option value="in_qc" {{ old('status', $incomingGood->status) == 'in_qc' ? 'selected' : '' }}>Di QC</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="po_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Purchase Order
                                </label>
                                <select name="po_id" id="po_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih PO (Opsional)</option>
                                    @foreach($purchaseOrders as $po)
                                        <option value="{{ $po->id }}" {{ old('po_id', $incomingGood->po_id) == $po->id ? 'selected' : '' }}>{{ $po->po_number }}</option>
                                    @endforeach
                                </select>
                                @error('po_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sales_channel_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Sales Channel
                                </label>
                                <select name="sales_channel_id" id="sales_channel_id"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih Channel (Opsional)</option>
                                    @foreach($salesChannels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('sales_channel_id', $incomingGood->sales_channel_id) == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                                @error('sales_channel_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $incomingGood->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('incoming-goods.index') }}"
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

