<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perbandingan Laporan - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        {{-- ─── SIDEBAR ─────────────────────────────── --}}
            <aside class="w-72 bg-gradient-to-b from-indigo-900 to-indigo-800 text-white flex flex-col shrink-0 shadow-2xl">
                {{-- Logo --}}
                <div class="px-6 py-7 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-white/10 p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg leading-tight">SpeakUp</p>
                            <p class="text-xs text-indigo-300">Admin Panel</p>
                        </div>
                    </div>
                </div>

                {{-- Nav --}}
                <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
                    <!-- Menu Manajemen Laporan -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Manajemen Laporan</span>
                        @if(isset($stats['baru_hari_ini']) && $stats['baru_hari_ini'] > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full badge-new">
                                {{ $stats['baru_hari_ini'] }}
                            </span>
                        @endif
                    </a>

                    <!--MENU KATEGORI LAPORAN -->
                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.kategori.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Kategori Laporan</span>
                    </a>

                    <!-- Menu Bukti Fisik (dari branch kita) -->
                    <a href="{{ route('admin.bukti.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.bukti.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Bukti Fisik</span>
                    </a>

                    <!-- Menu Customer Service -->
                    <a href="{{ route('admin.chat.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.chat.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                        </svg>
                        <span>Customer Service</span>
                    </a>

                    <!-- Menu Perbandingan Laporan (dari main) -->
                    <a href="{{ route('admin.perbandingan-laporan') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.perbandingan-laporan') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Perbandingan Laporan</span>
                    </a>

                    @if(Auth::user()->role === 'super_admin')
                    <!-- Menu Kelola User -->
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Kelola User</span>
                    </a>
                    @endif
                </nav>

                {{-- User + Logout --}}
                <div class="px-4 py-5 border-t border-white/10">
                    <div class="flex items-center gap-3 mb-4 px-2">
                        <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-sm font-bold uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-300 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 rounded-xl px-4 py-2.5 text-indigo-200 hover:bg-red-600 hover:text-white transition font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>
            </header>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Perbandingan Laporan</h1>
                    <p class="text-sm text-gray-500 mt-1">Bandingkan laporan berdasarkan bulan, kategori masalah, dan status penanganan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="openCreateModal()" class="flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Perbandingan Baru
                    </button>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-auto p-8">
                <!-- Filter Bar -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Perbandingan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Awal</label>
                            <input type="month" id="filterStartMonth" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Akhir</label>
                            <input type="month" id="filterEndMonth" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Masalah</label>
                            <select id="filterCategory" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                                <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                                <option value="Kekerasan Verbal">Kekerasan Verbal</option>
                                <option value="Diskriminasi">Diskriminasi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Laporan</label>
                            <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Perbandingan</label>
                            <select id="filterType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Semua Tipe</option>
                                <option value="bulanan">Bulanan</option>
                                <option value="kategori">Kategori</option>
                                <option value="status">Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        <button onclick="applyFilter()" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                            Terapkan Filter
                        </button>
                        <button onclick="resetFilter()" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6" id="summaryCards">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-indigo-100 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Laporan</p>
                                <p id="cardTotalLaporan" class="text-3xl font-bold text-indigo-600">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-amber-100 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kategori Paling Sering</p>
                                <p id="cardKategoriTerbanyak" class="text-lg font-bold text-amber-600">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center gap-4">
                            <div class="rounded-full bg-green-100 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status Terbanyak</p>
                                <p id="cardStatusTerbanyak" class="text-lg font-bold text-green-600">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6" id="chartsSection" style="display: none;">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Jumlah Laporan per Bulan</h3>
                        <canvas id="barChart" height="250"></canvas>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Masalah</h3>
                        <canvas id="donutChart" height="250"></canvas>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-8 py-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Perbandingan</h2>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Perbandingan</p>
                            <p id="totalComparisons" class="text-3xl font-bold text-indigo-600">{{ count($comparisons) }}</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Perbandingan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Rentang Bulan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori Masalah</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tipe Perbandingan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah Laporan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="comparisonTableBody" class="divide-y divide-gray-200">
                                @forelse($comparisons as $index => $comparison)
                                <tr class="hover:bg-gray-50 transition comparison-row"
                                    data-id="{{ $comparison->id }}"
                                    data-name="{{ $comparison->name }}"
                                    data-start="{{ $comparison->start_month->format('Y-m') }}"
                                    data-end="{{ $comparison->end_month->format('Y-m') }}"
                                    data-category="{{ $comparison->category_filter ?? '' }}"
                                    data-status="{{ $comparison->status_filter ?? '' }}"
                                    data-type="{{ $comparison->comparison_type }}"
                                    data-notes="{{ $comparison->notes ?? '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">{{ $comparison->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $comparison->start_month->format('M Y') }} - {{ $comparison->end_month->format('M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $comparison->category_filter ?? 'Semua' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($comparison->status_filter)
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if($comparison->status_filter == 'Menunggu Verifikasi') bg-yellow-100 text-yellow-800
                                            @elseif($comparison->status_filter == 'Diproses') bg-blue-100 text-blue-800
                                            @elseif($comparison->status_filter == 'Selesai') bg-green-100 text-green-800
                                            @elseif($comparison->status_filter == 'Ditolak') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $comparison->status_filter }}
                                        </span>
                                        @else
                                        <span class="text-sm text-gray-400">Semua</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                                            {{ ucfirst($comparison->comparison_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 jumlah-laporan" data-id="{{ $comparison->id }}">
                                        <span class="text-gray-400">Memuat...</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <button onclick="viewResult({{ $comparison->id }})" class="text-indigo-600 hover:text-indigo-900 transition" title="Lihat Hasil">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            <button onclick="openEditModal({{ $comparison->id }})" class="text-amber-600 hover:text-amber-900 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="deleteComparison({{ $comparison->id }})" class="text-red-600 hover:text-red-900 transition" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="emptyRow">
                                    <td colspan="8" class="px-8 py-12 text-center text-gray-500">
                                        Belum ada data perbandingan. Klik "Buat Perbandingan Baru" untuk memulai.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Create/Edit Modal -->
    <div id="formModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4">
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                <h3 id="formModalTitle" class="text-xl font-bold text-gray-900">Buat Perbandingan Baru</h3>
                <button onclick="closeFormModal()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-8 py-6 space-y-4 max-h-[70vh] overflow-y-auto">
                <div id="formErrors" class="hidden rounded-lg bg-red-50 border border-red-200 p-4 text-red-700 text-sm"></div>

                <input type="hidden" id="formComparisonId" value="">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perbandingan <span class="text-red-500">*</span></label>
                    <input type="text" id="formName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Contoh: Perbandingan Q1 2026">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Awal <span class="text-red-500">*</span></label>
                        <input type="month" id="formStartMonth" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan Akhir <span class="text-red-500">*</span></label>
                        <input type="month" id="formEndMonth" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Masalah</label>
                    <select id="formCategory" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                        <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                        <option value="Kekerasan Verbal">Kekerasan Verbal</option>
                        <option value="Diskriminasi">Diskriminasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Laporan</label>
                    <select id="formStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Perbandingan <span class="text-red-500">*</span></label>
                    <select id="formType" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="kategori">Kategori</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                    <textarea id="formNotes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Catatan tambahan..."></textarea>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 flex justify-end gap-3">
                <button onclick="closeFormModal()" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 transition">Batal</button>
                <button onclick="submitForm()" id="formSubmitBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Result/Detail Modal -->
    <div id="resultModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full mx-4">
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                <h3 id="resultModalTitle" class="text-xl font-bold text-gray-900">Hasil Perbandingan</h3>
                <button onclick="closeResultModal()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-8 py-6 max-h-[75vh] overflow-y-auto">
                <div id="resultLoading" class="text-center py-8">
                    <p class="text-gray-500">Memuat hasil perbandingan...</p>
                </div>
                <div id="resultContent" class="hidden">
                    <!-- Summary -->
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-indigo-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Total Laporan</p>
                            <p id="resultTotal" class="text-2xl font-bold text-indigo-600"></p>
                        </div>
                        <div class="bg-amber-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Kategori Terbanyak</p>
                            <p id="resultKategori" class="text-lg font-bold text-amber-600"></p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Status Terbanyak</p>
                            <p id="resultStatus" class="text-lg font-bold text-green-600"></p>
                        </div>
                    </div>
                    <!-- Charts in modal -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Laporan per Bulan</h4>
                            <canvas id="modalBarChart" height="200"></canvas>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Kategori Masalah</h4>
                            <canvas id="modalDonutChart" height="200"></canvas>
                        </div>
                    </div>
                    <!-- Detail table -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Detail per Status</h4>
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="resultStatusTable" class="divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                    <!-- Empty state -->
                    <div id="resultEmpty" class="hidden text-center py-8">
                        <p class="text-gray-500">Belum ada data laporan yang sesuai dengan filter ini.</p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 flex justify-end">
                <button onclick="closeResultModal()" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 transition">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let barChartInstance = null;
        let donutChartInstance = null;
        let modalBarChartInstance = null;
        let modalDonutChartInstance = null;

        const chartColors = [
            'rgba(99, 102, 241, 0.8)',   // indigo
            'rgba(245, 158, 11, 0.8)',   // amber
            'rgba(16, 185, 129, 0.8)',   // green
            'rgba(239, 68, 68, 0.8)',    // red
            'rgba(139, 92, 246, 0.8)',   // violet
            'rgba(236, 72, 153, 0.8)',   // pink
            'rgba(14, 165, 233, 0.8)',   // sky
        ];

        // ========================
        // FILTER
        // ========================
        function applyFilter() {
            const startMonth = document.getElementById('filterStartMonth').value;
            const endMonth = document.getElementById('filterEndMonth').value;
            const category = document.getElementById('filterCategory').value;
            const status = document.getElementById('filterStatus').value;
            const type = document.getElementById('filterType').value;

            const rows = document.querySelectorAll('.comparison-row');
            let visibleCount = 0;

            rows.forEach(row => {
                let show = true;
                if (startMonth && row.dataset.start < startMonth) show = false;
                if (endMonth && row.dataset.end > endMonth) show = false;
                if (category && row.dataset.category !== category) show = false;
                if (status && row.dataset.status !== status) show = false;
                if (type && row.dataset.type !== type) show = false;

                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            document.getElementById('totalComparisons').textContent = visibleCount;
        }

        function resetFilter() {
            document.getElementById('filterStartMonth').value = '';
            document.getElementById('filterEndMonth').value = '';
            document.getElementById('filterCategory').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterType').value = '';

            const rows = document.querySelectorAll('.comparison-row');
            rows.forEach(row => row.style.display = '');
            document.getElementById('totalComparisons').textContent = rows.length;
        }

        // ========================
        // CREATE MODAL
        // ========================
        function openCreateModal() {
            document.getElementById('formModalTitle').textContent = 'Buat Perbandingan Baru';
            document.getElementById('formSubmitBtn').textContent = 'Simpan';
            document.getElementById('formComparisonId').value = '';
            document.getElementById('formName').value = '';
            document.getElementById('formStartMonth').value = '';
            document.getElementById('formEndMonth').value = '';
            document.getElementById('formCategory').value = '';
            document.getElementById('formStatus').value = '';
            document.getElementById('formType').value = '';
            document.getElementById('formNotes').value = '';
            document.getElementById('formErrors').classList.add('hidden');
            document.getElementById('formModal').classList.remove('hidden');
        }

        function openEditModal(id) {
            const row = document.querySelector(`.comparison-row[data-id="${id}"]`);
            if (!row) return;

            document.getElementById('formModalTitle').textContent = 'Edit Perbandingan';
            document.getElementById('formSubmitBtn').textContent = 'Perbarui';
            document.getElementById('formComparisonId').value = id;
            document.getElementById('formName').value = row.dataset.name;
            document.getElementById('formStartMonth').value = row.dataset.start;
            document.getElementById('formEndMonth').value = row.dataset.end;
            document.getElementById('formCategory').value = row.dataset.category;
            document.getElementById('formStatus').value = row.dataset.status;
            document.getElementById('formType').value = row.dataset.type;
            document.getElementById('formNotes').value = row.dataset.notes;
            document.getElementById('formErrors').classList.add('hidden');
            document.getElementById('formModal').classList.remove('hidden');
        }

        function closeFormModal() {
            document.getElementById('formModal').classList.add('hidden');
        }

        // ========================
        // FORM SUBMIT (CREATE/UPDATE)
        // ========================
        async function submitForm() {
            const id = document.getElementById('formComparisonId').value;
            const name = document.getElementById('formName').value.trim();
            const startMonth = document.getElementById('formStartMonth').value;
            const endMonth = document.getElementById('formEndMonth').value;
            const category = document.getElementById('formCategory').value;
            const status = document.getElementById('formStatus').value;
            const type = document.getElementById('formType').value;
            const notes = document.getElementById('formNotes').value.trim();

            // Client-side validation
            const errors = [];
            if (!name) errors.push('Nama perbandingan wajib diisi.');
            if (!startMonth) errors.push('Bulan awal wajib diisi.');
            if (!endMonth) errors.push('Bulan akhir wajib diisi.');
            if (startMonth && endMonth && endMonth < startMonth) errors.push('Bulan akhir tidak boleh lebih kecil dari bulan awal.');
            if (!type) errors.push('Tipe perbandingan wajib dipilih.');

            if (errors.length > 0) {
                const errDiv = document.getElementById('formErrors');
                errDiv.innerHTML = errors.map(e => `<p>${e}</p>`).join('');
                errDiv.classList.remove('hidden');
                return;
            }

            const payload = {
                name,
                start_month: startMonth + '-01',
                end_month: endMonth + '-01',
                category_filter: category || null,
                status_filter: status || null,
                comparison_type: type,
                notes: notes || null,
            };

            const url = id
                ? `/admin/report-comparisons/${id}`
                : '/admin/report-comparisons';

            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    closeFormModal();
                    location.reload();
                } else {
                    const errDiv = document.getElementById('formErrors');
                    if (data.errors) {
                        const msgs = Object.values(data.errors).flat();
                        errDiv.innerHTML = msgs.map(e => `<p>${e}</p>`).join('');
                    } else {
                        errDiv.innerHTML = `<p>${data.message || 'Terjadi kesalahan.'}</p>`;
                    }
                    errDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                const errDiv = document.getElementById('formErrors');
                errDiv.innerHTML = '<p>Gagal menghubungi server.</p>';
                errDiv.classList.remove('hidden');
            }
        }

        // ========================
        // DELETE
        // ========================
        async function deleteComparison(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus perbandingan ini? Data laporan asli tetap aman.')) return;

            try {
                const response = await fetch(`/admin/report-comparisons/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus perbandingan.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menghubungi server.');
            }
        }

        // ========================
        // VIEW RESULT
        // ========================
        async function viewResult(id) {
            document.getElementById('resultModal').classList.remove('hidden');
            document.getElementById('resultLoading').classList.remove('hidden');
            document.getElementById('resultContent').classList.add('hidden');

            try {
                const response = await fetch(`/admin/report-comparisons/${id}/result`, {
                    headers: { 'Accept': 'application/json' },
                });
                const json = await response.json();

                if (!json.success) {
                    alert('Gagal memuat hasil.');
                    closeResultModal();
                    return;
                }

                const d = json.data;

                document.getElementById('resultModalTitle').textContent = `Hasil: ${d.comparison.name}`;
                document.getElementById('resultTotal').textContent = d.total_laporan;
                document.getElementById('resultKategori').textContent = d.kategori_terbanyak;
                document.getElementById('resultStatus').textContent = d.status_terbanyak;

                // Update main page cards too
                document.getElementById('cardTotalLaporan').textContent = d.total_laporan;
                document.getElementById('cardKategoriTerbanyak').textContent = d.kategori_terbanyak;
                document.getElementById('cardStatusTerbanyak').textContent = d.status_terbanyak;

                if (d.total_laporan === 0) {
                    document.getElementById('resultEmpty').classList.remove('hidden');
                    document.getElementById('resultLoading').classList.add('hidden');
                    document.getElementById('resultContent').classList.remove('hidden');
                    return;
                }

                document.getElementById('resultEmpty').classList.add('hidden');

                // Status table
                const tbody = document.getElementById('resultStatusTable');
                tbody.innerHTML = '';
                d.per_status.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td class="px-4 py-2">${item.status}</td><td class="px-4 py-2 font-semibold">${item.jumlah}</td>`;
                    tbody.appendChild(tr);
                });

                // Modal Bar Chart
                if (modalBarChartInstance) modalBarChartInstance.destroy();
                const mBarCtx = document.getElementById('modalBarChart').getContext('2d');
                modalBarChartInstance = new Chart(mBarCtx, {
                    type: 'bar',
                    data: {
                        labels: d.per_bulan.map(b => b.bulan),
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: d.per_bulan.map(b => b.jumlah),
                            backgroundColor: 'rgba(99, 102, 241, 0.8)',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                    }
                });

                // Modal Donut Chart
                if (modalDonutChartInstance) modalDonutChartInstance.destroy();
                const mDonutCtx = document.getElementById('modalDonutChart').getContext('2d');
                modalDonutChartInstance = new Chart(mDonutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: d.per_kategori.map(k => k.jenis_kejadian),
                        datasets: [{
                            data: d.per_kategori.map(k => k.jumlah),
                            backgroundColor: chartColors.slice(0, d.per_kategori.length),
                            borderWidth: 2,
                            borderColor: '#ffffff',
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { position: 'bottom' } },
                    }
                });

                // Also update the main page charts
                updateMainCharts(d);

                document.getElementById('resultLoading').classList.add('hidden');
                document.getElementById('resultContent').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat hasil perbandingan.');
                closeResultModal();
            }
        }

        function updateMainCharts(d) {
            document.getElementById('chartsSection').style.display = '';

            // Main Bar Chart
            if (barChartInstance) barChartInstance.destroy();
            const barCtx = document.getElementById('barChart').getContext('2d');
            barChartInstance = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: d.per_bulan.map(b => b.bulan),
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: d.per_bulan.map(b => b.jumlah),
                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                }
            });

            // Main Donut Chart
            if (donutChartInstance) donutChartInstance.destroy();
            const donutCtx = document.getElementById('donutChart').getContext('2d');
            donutChartInstance = new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: d.per_kategori.map(k => k.jenis_kejadian),
                    datasets: [{
                        data: d.per_kategori.map(k => k.jumlah),
                        backgroundColor: chartColors.slice(0, d.per_kategori.length),
                        borderWidth: 2,
                        borderColor: '#ffffff',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } },
                }
            });
        }

        function closeResultModal() {
            document.getElementById('resultModal').classList.remove('hidden');
            document.getElementById('resultModal').classList.add('hidden');
        }

        // ========================
        // LOAD JUMLAH LAPORAN PER ROW
        // ========================
        async function loadCounts() {
            const cells = document.querySelectorAll('.jumlah-laporan');
            for (const cell of cells) {
                const id = cell.dataset.id;
                try {
                    const response = await fetch(`/admin/report-comparisons/${id}/result`, {
                        headers: { 'Accept': 'application/json' },
                    });
                    const json = await response.json();
                    if (json.success) {
                        cell.innerHTML = `<span class="font-semibold text-indigo-600">${json.data.total_laporan}</span>`;
                    } else {
                        cell.innerHTML = '<span class="text-gray-400">-</span>';
                    }
                } catch (e) {
                    cell.innerHTML = '<span class="text-gray-400">Error</span>';
                }
            }
        }

        // ========================
        // MODAL CLICK OUTSIDE
        // ========================
        document.getElementById('formModal').addEventListener('click', function(e) {
            if (e.target === this) closeFormModal();
        });

        document.getElementById('resultModal').addEventListener('click', function(e) {
            if (e.target === this) closeResultModal();
        });

        // Load counts on page load
        loadCounts();
    </script>
</body>
</html>
