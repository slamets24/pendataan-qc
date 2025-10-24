<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'QC System') }} - Dashboard Publik</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ config('app.name', 'QC System') }}
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Dashboard Monitoring QC</p>
                    </div>

            @if (Route::has('login'))
                        <nav class="flex items-center space-x-4">
                    @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                    @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                    Login
                                </a>
                    @endauth
                </nav>
            @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="chartFilter()">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Barang Masuk -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Barang Masuk
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                            {{ number_format($totalIncomingGoods) }}
                                        </div>
                                        <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">pcs</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total QC Processed -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-12 w-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        QC Diproses
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                            {{ number_format($totalQCProcessed) }}
                                        </div>
                                        <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">pcs</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Kirim Packing -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-12 w-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Kirim Packing
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                            {{ number_format($totalOutgoingGoods) }}
                                        </div>
                                        <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">pcs</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- QC Process Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Proses QC</h3>
                            <select x-model="qcFilter" @change="updateCharts('qc')" class="text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="today">Hari Ini</option>
                                <option value="3days">3 Hari</option>
                                <option value="1week">1 Minggu</option>
                                <option value="1month">1 Bulan</option>
                                <option value="1year">1 Tahun</option>
                                <option value="all">Semuanya</option>
                            </select>
                        </div>
                        <canvas id="qcProcessChart" height="250"></canvas>
                    </div>
                </div>

                <!-- Status Barang Masuk Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status Barang Masuk</h3>
                            <select x-model="incomingFilter" @change="updateCharts('incoming')" class="text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="today">Hari Ini</option>
                                <option value="3days">3 Hari</option>
                                <option value="1week">1 Minggu</option>
                                <option value="1month">1 Bulan</option>
                                <option value="1year">1 Tahun</option>
                                <option value="all">Semuanya</option>
                            </select>
                        </div>
                        <canvas id="statusChart" height="250"></canvas>
                    </div>
                </div>

                <!-- Status Outgoing Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status Kirim Packing</h3>
                            <select x-model="outgoingFilter" @change="updateCharts('outgoing')" class="text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="today">Hari Ini</option>
                                <option value="3days">3 Hari</option>
                                <option value="1week">1 Minggu</option>
                                <option value="1month">1 Bulan</option>
                                <option value="1year">1 Tahun</option>
                                <option value="all">Semuanya</option>
                            </select>
                        </div>
                        <canvas id="outgoingChart" height="250"></canvas>
                    </div>
                </div>
        </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Dashboard ini menampilkan data real-time dari sistem QC.
                    <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Login</a> untuk akses penuh.
                </p>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script>
            // Alpine.js component for chart filtering
            function chartFilter() {
                return {
                    qcFilter: 'today',
                    incomingFilter: 'today',
                    outgoingFilter: 'today',

                    async updateCharts(chartType) {
                        let filter;
                        if (chartType === 'qc') filter = this.qcFilter;
                        else if (chartType === 'incoming') filter = this.incomingFilter;
                        else if (chartType === 'outgoing') filter = this.outgoingFilter;

                        try {
                            const response = await fetch(`{{ route('dashboard.chart-data') }}?filter=${filter}`);
                            const data = await response.json();

                            if (chartType === 'qc') {
                                updateQCChart(data.qcByProcess);
                            } else if (chartType === 'incoming') {
                                updateIncomingChart(data.incomingByStatus);
                            } else if (chartType === 'outgoing') {
                                updateOutgoingChart(data.outgoingByStatus);
                            }
                        } catch (error) {
                            console.error('Error fetching chart data:', error);
                        }
                    }
                }
            }

            // Store chart instances
            let qcProcessChart, statusChart, outgoingChart;

            // QC Process Chart
            const qcProcessCtx = document.getElementById('qcProcessChart').getContext('2d');
            qcProcessChart = new Chart(qcProcessCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($qcByProcess->pluck('process')->map(function($p) {
                        $translations = [
                            'hanging' => 'Hanging',
                            'buttoning' => 'Kancing',
                            'plating' => 'Plating',
                            'steaming' => 'Setrika',
                            'thread_trimming' => 'Potong Benang'
                        ];
                        return $translations[$p] ?? ucfirst(str_replace('_', ' ', $p));
                    })) !!},
                    datasets: [{
                        label: 'Jumlah Diproses',
                        data: {!! json_encode($qcByProcess->pluck('total')) !!},
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(139, 92, 246)',
                            'rgb(239, 68, 68)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($incomingByStatus->pluck('status')->map(function($s) {
                        $translations = [
                            'received' => 'Diterima',
                            'qc' => 'QC',
                            'completed' => 'Selesai',
                            'revised' => 'Revisi'
                        ];
                        return $translations[$s] ?? ucfirst($s);
                    })) !!},
                    datasets: [{
                        data: {!! json_encode($incomingByStatus->pluck('total')) !!},
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                        ],
                        borderColor: [
                            'rgb(59, 130, 246)',
                            'rgb(245, 158, 11)',
                            'rgb(16, 185, 129)',
                            'rgb(239, 68, 68)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' pcs';
                                    return label;
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: function(value, context) {
                                return value > 0 ? value : '';
                            }
                        }
                    }
                }
            });

            // Outgoing Goods Chart
            const outgoingCtx = document.getElementById('outgoingChart').getContext('2d');
            outgoingChart = new Chart(outgoingCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($outgoingByStatus->pluck('status')->map(function($s) {
                        $translations = [
                            'sent_to_packing' => 'Kirim Packing',
                            'returned_to_qc' => 'Return QC',
                            'cancelled' => 'Dibatalkan'
                        ];
                        return $translations[$s] ?? ucfirst(str_replace('_', ' ', $s));
                    })) !!},
                    datasets: [{
                        data: {!! json_encode($outgoingByStatus->pluck('total')) !!},
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                        ],
                        borderColor: [
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' pcs';
                                    return label;
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 14
                            },
                            formatter: function(value, context) {
                                return value > 0 ? value : '';
                            }
                        }
                    }
                }
            });

            // Update functions for each chart
            function updateQCChart(data) {
                const translations = {
                    'hanging': 'Hanging',
                    'buttoning': 'Kancing',
                    'plating': 'Plating',
                    'steaming': 'Setrika',
                    'thread_trimming': 'Potong Benang'
                };

                const labels = data.map(item => translations[item.process] || item.process.replace('_', ' '));
                const values = data.map(item => item.total);

                qcProcessChart.data.labels = labels;
                qcProcessChart.data.datasets[0].data = values;
                qcProcessChart.update();
            }

            function updateIncomingChart(data) {
                const translations = {
                    'received': 'Diterima',
                    'qc': 'QC',
                    'completed': 'Selesai',
                    'revised': 'Revisi'
                };

                const labels = data.map(item => translations[item.status] || item.status);
                const values = data.map(item => item.total);

                statusChart.data.labels = labels;
                statusChart.data.datasets[0].data = values;
                statusChart.update();
            }

            function updateOutgoingChart(data) {
                const translations = {
                    'sent_to_packing': 'Kirim Packing',
                    'returned_to_qc': 'Return QC',
                    'cancelled': 'Dibatalkan'
                };

                const labels = data.map(item => translations[item.status] || item.status.replace('_', ' '));
                const values = data.map(item => item.total);

                outgoingChart.data.labels = labels;
                outgoingChart.data.datasets[0].data = values;
                outgoingChart.update();
            }
        </script>
    </body>
</html>
