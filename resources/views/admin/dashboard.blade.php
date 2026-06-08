<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SpeakUp</title>
    <meta name="description" content="Panel admin SpeakUp untuk mengelola laporan pelecehan dan diskriminasi.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* Animasi badge baru */
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.4); opacity: 0.7; }
        }
        .badge-new { animation: pulse-dot 1.5s ease-in-out infinite; }

        /* Row highlight laporan baru */
        .row-baru {
            border-left: 4px solid #6366f1;
            background: linear-gradient(90deg, #eef2ff 0%, #fff 60%);
        }

        /* Card stats */
        .stat-card {
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,.1);
        }

        /* Scroll tabel */
        .tabel-scroll { max-height: calc(100vh - 340px); overflow-y: auto; }
        .tabel-scroll thead th { position: sticky; top: 0; z-index: 10; }
    </style>
</head>
<body class="bg-slate-50">

<div class="flex h-screen overflow-hidden">

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
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 rounded-xl bg-white/15 px-4 py-3 text-white font-medium transition hover:bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span>Manajemen Laporan</span>
                @if($stats['baru_hari_ini'] > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full badge-new">
                        {{ $stats['baru_hari_ini'] }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.chat.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-indigo-200 font-medium transition hover:bg-white/10 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                </svg>
                <span>Customer Service</span>
            </a>

            @if(Auth::user()->role === 'super_admin')
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-indigo-200 font-medium transition hover:bg-white/10 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18a6 6 0 0112 0"/>
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

    {{-- ─── MAIN CONTENT ───────────────────────── --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Header --}}
        <header class="bg-white border-b border-slate-200 px-8 py-5 flex items-center justify-between shrink-0">
            <div>
                <p class="text-sm text-slate-500">Selamat datang,</p>
                <h1 class="text-2xl font-bold text-slate-900">Dashboard Laporan</h1>
            </div>
            <div class="flex items-center gap-3">
                @if($stats['baru_hari_ini'] > 0)
                <span class="inline-flex items-center gap-1.5 bg-indigo-50 border border-indigo-200 text-indigo-700 text-sm font-semibold px-3 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 badge-new inline-block"></span>
                    {{ $stats['baru_hari_ini'] }} laporan baru hari ini
                </span>
                @endif
                <a href="{{ route('lapor.create') }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Form Lapor
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-auto p-8">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 px-5 py-4 text-emerald-800" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
            @endif

            {{-- ─── STATISTIK CARDS ─── --}}
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                {{-- Total --}}
                <div class="stat-card bg-white rounded-2xl p-5 border border-slate-200 shadow-sm lg:col-span-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Total Laporan</p>
                    <p class="text-4xl font-extrabold text-slate-800">{{ $stats['total'] }}</p>
                    <div class="mt-2 flex items-center gap-1 text-indigo-600 text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Semua laporan
                    </div>
                </div>

                {{-- Menunggu --}}
                <div class="stat-card bg-white rounded-2xl p-5 border border-yellow-200 shadow-sm">
                    <p class="text-xs font-semibold text-yellow-600 uppercase tracking-wider mb-2">Menunggu</p>
                    <p class="text-4xl font-extrabold text-yellow-700">{{ $stats['menunggu_verifikasi'] }}</p>
                    <div class="mt-2 w-full bg-yellow-100 rounded-full h-1.5">
                        <div class="bg-yellow-400 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round($stats['menunggu_verifikasi'] / $stats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>

                {{-- Diproses --}}
                <div class="stat-card bg-white rounded-2xl p-5 border border-blue-200 shadow-sm">
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Diproses</p>
                    <p class="text-4xl font-extrabold text-blue-700">{{ $stats['diproses'] }}</p>
                    <div class="mt-2 w-full bg-blue-100 rounded-full h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round($stats['diproses'] / $stats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>

                {{-- Selesai --}}
                <div class="stat-card bg-white rounded-2xl p-5 border border-emerald-200 shadow-sm">
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-2">Selesai</p>
                    <p class="text-4xl font-extrabold text-emerald-700">{{ $stats['selesai'] }}</p>
                    <div class="mt-2 w-full bg-emerald-100 rounded-full h-1.5">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round($stats['selesai'] / $stats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>

                {{-- Ditolak --}}
                <div class="stat-card bg-white rounded-2xl p-5 border border-red-200 shadow-sm">
                    <p class="text-xs font-semibold text-red-500 uppercase tracking-wider mb-2">Ditolak</p>
                    <p class="text-4xl font-extrabold text-red-600">{{ $stats['ditolak'] }}</p>
                    <div class="mt-2 w-full bg-red-100 rounded-full h-1.5">
                        <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ $stats['total'] > 0 ? round($stats['ditolak'] / $stats['total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            {{-- ─── TABEL LAPORAN ─── --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                {{-- Toolbar --}}
                <div class="px-6 py-5 border-b border-slate-100 flex flex-wrap items-center gap-3 justify-between">
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg font-bold text-slate-800">Daftar Laporan Masuk</h2>
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ $laporans->count() }} hasil
                        </span>
                    </div>

                    {{-- Filter & Search --}}
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari kode / jenis / lokasi…"
                               class="text-sm border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 w-52">

                        <select name="status" class="text-sm border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            <option value="">Semua Status</option>
                            <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="Diproses"            {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai"             {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak"             {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                        <select name="jenis" class="text-sm border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            <option value="">Semua Jenis</option>
                            <option value="Pelecehan Seksual"  {{ request('jenis') == 'Pelecehan Seksual' ? 'selected' : '' }}>Pelecehan Seksual</option>
                            <option value="Kekerasan Fisik"    {{ request('jenis') == 'Kekerasan Fisik' ? 'selected' : '' }}>Kekerasan Fisik</option>
                            <option value="Kekerasan Verbal"   {{ request('jenis') == 'Kekerasan Verbal' ? 'selected' : '' }}>Kekerasan Verbal</option>
                            <option value="Diskriminasi"       {{ request('jenis') == 'Diskriminasi' ? 'selected' : '' }}>Diskriminasi</option>
                            <option value="Lainnya"            {{ request('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>

                        <button type="submit"
                            class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                            Filter
                        </button>
                        @if(request()->hasAny(['search','status','jenis']))
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-sm text-slate-500 hover:text-slate-700 px-2 py-2 underline underline-offset-2">
                            Reset
                        </a>
                        @endif
                    </form>
                </div>

                {{-- Table --}}
                <div class="tabel-scroll">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Kode Tracking</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Tanggal Lapor</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Jenis Kejadian</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($laporans as $laporan)
                            @php
                                $isNew = $laporan->tanggal_lapor && $laporan->tanggal_lapor->isToday();
                            @endphp
                            <tr class="hover:bg-slate-50 transition {{ $isNew ? 'row-baru' : '' }}">

                                {{-- Kode Tracking --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono font-semibold text-indigo-600">{{ $laporan->kode_tracking }}</span>
                                        @if($isNew)
                                            <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-1.5 py-0.5 rounded-full uppercase">Baru</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Tanggal Lapor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                    <div>{{ $laporan->tanggal_lapor ? $laporan->tanggal_lapor->format('d M Y') : '-' }}</div>
                                    <div class="text-xs text-slate-400">{{ $laporan->tanggal_lapor ? $laporan->tanggal_lapor->format('H:i') : '' }}</div>
                                </td>

                                {{-- Jenis --}}
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">
                                    {{ $laporan->jenis_kejadian }}
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-6 py-4 text-slate-600 max-w-[180px] truncate" title="{{ $laporan->lokasi }}">
                                    {{ $laporan->lokasi }}
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.reports.updateStatus', $laporan->id_laporan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" id="status-{{ $laporan->id_laporan }}"
                                            onchange="this.form.submit()"
                                            class="text-xs font-semibold px-2.5 py-1.5 rounded-lg border cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-300
                                            @if($laporan->status == 'Menunggu Verifikasi') bg-yellow-50 border-yellow-300 text-yellow-800
                                            @elseif($laporan->status == 'Diproses')        bg-blue-50 border-blue-300 text-blue-800
                                            @elseif($laporan->status == 'Selesai')         bg-emerald-50 border-emerald-300 text-emerald-800
                                            @else                                          bg-red-50 border-red-300 text-red-700
                                            @endif">
                                            <option value="Menunggu Verifikasi" {{ $laporan->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>⏳ Menunggu Verifikasi</option>
                                            <option value="Diproses"            {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                            <option value="Selesai"             {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                            <option value="Ditolak"             {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                        </select>
                                    </form>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1">
                                        {{-- Detail --}}
                                        <button onclick="showDetail({{ $laporan->id_laporan }})"
                                            title="Lihat Detail"
                                            class="p-2 rounded-lg text-indigo-600 hover:bg-indigo-50 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.reports.destroy', $laporan->id_laporan) }}" method="POST"
                                              onsubmit="return confirm('Hapus laporan {{ $laporan->kode_tracking }}? Tindakan ini tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Laporan"
                                                class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-slate-500 font-medium">Tidak ada laporan ditemukan</p>
                                    <p class="text-slate-400 text-sm mt-1">Coba ubah filter atau reset pencarian</p>
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

{{-- ─── MODAL DETAIL ─────────────────────────────────────────────── --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh]">

        {{-- Header modal --}}
        <div class="px-7 py-5 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Detail Laporan</h3>
                    <p id="detailKodeModal" class="text-sm font-mono text-indigo-600"></p>
                </div>
            </div>
            <button onclick="closeDetail()" class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body modal --}}
        <div class="flex-1 overflow-y-auto px-7 py-6 space-y-5">

            {{-- Status + tanggal --}}
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Status</p>
                    <p id="detailStatus"></p>
                </div>
                <div class="flex-1 bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tanggal Lapor</p>
                    <p id="detailTanggalLapor" class="font-medium text-slate-800"></p>
                </div>
            </div>

            {{-- Jenis + Lokasi --}}
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Jenis Kejadian</p>
                    <p id="detailJenis" class="font-semibold text-slate-800"></p>
                </div>
                <div class="flex-1 bg-slate-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Lokasi</p>
                    <p id="detailLokasi" class="font-medium text-slate-800"></p>
                </div>
            </div>

            {{-- Waktu kejadian --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Waktu Kejadian</p>
                <p id="detailTanggal" class="font-medium text-slate-800"></p>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</p>
                <p id="detailDeskripsi" class="text-slate-700 leading-relaxed whitespace-pre-wrap"></p>
            </div>

            {{-- No Telp --}}
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nomor Telepon</p>
                <p id="detailPhone" class="font-medium text-slate-800"></p>
            </div>

            {{-- Bukti --}}
            <div id="detailBuktiSection" class="hidden">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Bukti Terlampir</p>
                <div id="buktiContainer" class="grid grid-cols-2 gap-3"></div>
            </div>
        </div>

        {{-- Footer modal --}}
        <div class="px-7 py-4 border-t border-slate-200 flex justify-end shrink-0">
            <button onclick="closeDetail()"
                class="px-5 py-2 rounded-xl bg-slate-100 text-slate-700 font-medium hover:bg-slate-200 transition text-sm">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function showDetail(id) {
        fetch(`/admin/reports/${id}/detail`)
            .then(r => r.json())
            .then(data => {
                document.getElementById('detailKodeModal').textContent = data.kode_tracking;
                document.getElementById('detailJenis').textContent     = data.jenis_kejadian;
                document.getElementById('detailLokasi').textContent    = data.lokasi;
                document.getElementById('detailDeskripsi').textContent = data.deskripsi;
                document.getElementById('detailPhone').textContent     = data.phone || 'Tidak disediakan';

                // Tanggal kejadian
                const tgl = data.tanggal_kejadian ? new Date(data.tanggal_kejadian) : null;
                document.getElementById('detailTanggal').textContent =
                    tgl ? tgl.toLocaleString('id-ID', {dateStyle:'long', timeStyle:'short'}) : '-';

                // Tanggal lapor
                const tglLapor = data.tanggal_lapor ? new Date(data.tanggal_lapor) : null;
                document.getElementById('detailTanggalLapor').textContent =
                    tglLapor ? tglLapor.toLocaleString('id-ID', {dateStyle:'long', timeStyle:'short'}) : '-';

                // Status badge
                const statusMap = {
                    'Menunggu Verifikasi': 'bg-yellow-100 text-yellow-800',
                    'Diproses':            'bg-blue-100 text-blue-800',
                    'Selesai':             'bg-emerald-100 text-emerald-800',
                    'Ditolak':             'bg-red-100 text-red-700',
                };
                const cls = statusMap[data.status] || 'bg-slate-100 text-slate-700';
                document.getElementById('detailStatus').innerHTML =
                    `<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold ${cls}">${data.status}</span>`;

                // Bukti
                const buktiContainer = document.getElementById('buktiContainer');
                buktiContainer.innerHTML = '';
                if (data.buktis && data.buktis.length > 0) {
                    document.getElementById('detailBuktiSection').classList.remove('hidden');
                    data.buktis.forEach(bukti => {
                        if (bukti.tipe_file && bukti.tipe_file.startsWith('image')) {
                            const img = document.createElement('img');
                            img.src = `/storage/${bukti.file_bukti}`;
                            img.className = 'w-full rounded-xl shadow-sm object-cover';
                            img.alt = 'Bukti laporan';
                            buktiContainer.appendChild(img);
                        } else {
                            const link = document.createElement('a');
                            link.href = `/storage/${bukti.file_bukti}`;
                            link.target = '_blank';
                            link.className = 'flex items-center gap-2 bg-white border border-slate-200 rounded-xl p-3 hover:bg-slate-50 transition text-indigo-600 text-sm font-medium';
                            link.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Unduh Dokumen`;
                            buktiContainer.appendChild(link);
                        }
                    });
                } else {
                    document.getElementById('detailBuktiSection').classList.add('hidden');
                }

                document.getElementById('detailModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(() => alert('Gagal memuat detail laporan.'));
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetail();
    });
</script>
</body>
</html>