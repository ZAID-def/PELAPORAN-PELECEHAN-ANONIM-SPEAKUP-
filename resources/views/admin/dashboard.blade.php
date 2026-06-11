<!DOCTYPE html>
<html lang="en">
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-indigo-900 text-white p-6 flex flex-col">
            <div class="flex items-center gap-3 mb-8">
                <div class="rounded-full bg-white/10 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-wider">SpeakUp</p>
                    <p class="text-xs text-indigo-200">Admin Panel</p>
                </div>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-3 text-white hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Manajemen Laporan</span>
                </a>

                <a href="{{ route('admin.chat.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                    <span>Customer Service</span>
                </a>

                <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>Kategori Kejadian</span>
                </a>

                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18a6 6 0 0112 0"/>
                    </svg>
                    <span>Kelola User</span>
                </a>
                @endif
            </nav>

            <div class="border-t border-white/10 pt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-red-600 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-auto p-8">
                @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-8 py-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Laporan Masuk</h2>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Laporan</p>
                            <p class="text-3xl font-bold text-indigo-600">{{ count($laporans) }}</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Laporan</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis Kejadian</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($laporans as $laporan)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-indigo-600">{{ $laporan->kode_tracking }}</span>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $laporan->tanggal_kejadian->format('Y-m-d') }}
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $laporan->jenis_kejadian }}
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.reports.updateStatus', $laporan->id_laporan) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-1.5 border rounded-lg cursor-pointer
                                                @if($laporan->status == 'Menunggu Verifikasi') bg-yellow-100 border-yellow-300 text-yellow-800
                                                @elseif($laporan->status == 'Diproses') bg-blue-100 border-blue-300 text-blue-800
                                                @elseif($laporan->status == 'Selesai') bg-green-100 border-green-300 text-green-800
                                                @else bg-gray-100 border-gray-300 text-gray-800
                                                @endif">
                                                <option value="Menunggu Verifikasi" {{ $laporan->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                                <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <button onclick="showDetail({{ $laporan->id_laporan }})" class="text-indigo-600 hover:text-indigo-900 transition" title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            <form action="{{ route('admin.reports.destroy', $laporan->id_laporan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Hapus Laporan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center text-gray-500">
                                        Tidak ada laporan masuk
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

    <!-- Detail Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-4">
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Detail Laporan</h3>
                <button onclick="closeDetail()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-8 py-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">ID Laporan</p>
                        <p id="detailId" class="text-lg font-semibold text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p id="detailStatus" class="text-lg font-semibold"></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jenis Kejadian</p>
                    <p id="detailJenis" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Lokasi</p>
                    <p id="detailLokasi" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kejadian</p>
                    <p id="detailTanggal" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Deskripsi</p>
                    <p id="detailDeskripsi" class="text-base text-gray-900 bg-gray-50 p-3 rounded-lg whitespace-pre-wrap"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nomor Telepon</p>
                    <p id="detailPhone" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div id="detailBukti" class="hidden">
                    <p class="text-sm text-gray-600">Bukti</p>
                    <div id="buktiContainer" class="grid grid-cols-1 gap-2"></div>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 flex justify-end">
                <button onclick="closeDetail()" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function showDetail(id) {
            fetch(`/admin/reports/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailId').textContent = data.kode_tracking;
                    document.getElementById('detailJenis').textContent = data.jenis_kejadian;
                    document.getElementById('detailLokasi').textContent = data.lokasi;
                    document.getElementById('detailDeskripsi').textContent = data.deskripsi;
                    document.getElementById('detailTanggal').textContent = new Date(data.tanggal_kejadian).toLocaleString('id-ID');
                    document.getElementById('detailPhone').textContent = data.phone || 'Tidak disediakan';
                    
                    let statusColor = 'bg-gray-100 text-gray-800';
                    if(data.status === 'Menunggu Verifikasi') statusColor = 'bg-yellow-100 text-yellow-800';
                    else if(data.status === 'Diproses') statusColor = 'bg-blue-100 text-blue-800';
                    else if(data.status === 'Selesai') statusColor = 'bg-green-100 text-green-800';
                    else if(data.status === 'Ditolak') statusColor = 'bg-red-100 text-red-800';
                    
                    document.getElementById('detailStatus').innerHTML = `<span class="px-3 py-1 rounded-full text-xs font-semibold ${statusColor}">${data.status}</span>`;
                    
                    // Tampilkan bukti
                    const buktiContainer = document.getElementById('buktiContainer');
                    buktiContainer.innerHTML = '';
                    if(data.buktis && data.buktis.length > 0) {
                        document.getElementById('detailBukti').classList.remove('hidden');
                        data.buktis.forEach(bukti => {
                            const img = document.createElement('img');
                            img.src = `/storage/${bukti.file_bukti}`;
                            img.className = 'max-w-full h-auto rounded-lg shadow-md';
                            img.alt = 'Bukti laporan';
                            buktiContainer.appendChild(img);
                        });
                    } else {
                        document.getElementById('detailBukti').classList.add('hidden');
                    }
                    
                    document.getElementById('detailModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail laporan');
                });
        }
        
        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if(e.target === this) closeDetail();
        });
    </script>
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
                    <table class="w-full text-sm divide-y divide-slate-100">
                        <thead class="bg-white border-b border-slate-200 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kode Tracking
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Tanggal Lapor
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jenis Kejadian
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider w-24">
                                    Aksi
                                </th>
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
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl flex flex-col max-h-[90vh]">

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

        {{-- Tab Navigation --}}
        <div class="flex gap-8 px-7 pt-5 border-b border-slate-200 shrink-0">
            <button onclick="switchDetailTab('detail')" 
                class="pb-3 px-1 font-semibold text-slate-600 border-b-2 border-transparent hover:text-slate-900 transition" 
                id="tab-detail-btn">
                📋 Detail
            </button>
            <button onclick="switchDetailTab('notes')" 
                class="pb-3 px-1 font-semibold text-slate-400 border-b-2 border-transparent hover:text-slate-600 transition" 
                id="tab-notes-btn">
                📝 Notes
            </button>
        </div>

        {{-- Body modal --}}
        <div class="flex-1 overflow-y-auto px-7 py-6">
            
            {{-- TAB DETAIL --}}
            <div id="detail-content" class="space-y-5">
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

            {{-- TAB NOTES --}}
            <div id="notes-content" class="hidden">
                {{-- Add New Note Section --}}
                <div class="bg-slate-50 rounded-xl p-5 mb-6">
                    <p class="text-sm font-semibold text-slate-700 mb-3">Tambah Catatan Baru</p>
                    <textarea id="detailNotesTextarea"
                        rows="4"
                        class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 bg-white mb-3"
                        placeholder="Tulis catatan admin untuk penolakan/alasan..."></textarea>
                    
                    <button onclick="saveNotes()"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition text-sm">
                        ✏️ Tambah Notes
                    </button>
                </div>

                {{-- Notes List --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-semibold text-slate-800">Daftar Catatan</h4>
                        <span class="text-xs bg-slate-200 text-slate-700 px-2.5 py-1 rounded-full font-medium">
                            <span id="notesCount">0</span> catatan
                        </span>
                    </div>

                    <div id="notesList" class="space-y-3">
                        {{-- Notes akan di-render oleh JS --}}
                    </div>
                </div>
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
    let currentReportId = null;
    let currentNotes = [];

    function switchDetailTab(tab) {
        // Hide all tabs
        document.getElementById('detail-content').classList.add('hidden');
        document.getElementById('notes-content').classList.add('hidden');
        
        // Remove active state from all tabs
        document.getElementById('tab-detail-btn').classList.remove('border-b-indigo-600', 'text-indigo-600', 'text-slate-900');
        document.getElementById('tab-detail-btn').classList.add('text-slate-600');
        document.getElementById('tab-notes-btn').classList.remove('border-b-indigo-600', 'text-indigo-600', 'text-slate-900');
        document.getElementById('tab-notes-btn').classList.add('text-slate-400');
        
        // Show selected tab
        if (tab === 'detail') {
            document.getElementById('detail-content').classList.remove('hidden');
            document.getElementById('tab-detail-btn').classList.remove('text-slate-600');
            document.getElementById('tab-detail-btn').classList.add('border-b-2', 'border-b-indigo-600', 'text-slate-900');
        } else {
            document.getElementById('notes-content').classList.remove('hidden');
            document.getElementById('tab-notes-btn').classList.remove('text-slate-400');
            document.getElementById('tab-notes-btn').classList.add('border-b-2', 'border-b-indigo-600', 'text-slate-900');
            renderNotesList();
        }
    }

    function renderNotesList() {
        const notesList = document.getElementById('notesList');
        const notesCount = document.getElementById('notesCount');
        
        if (!currentNotes || currentNotes.length === 0) {
            notesList.innerHTML = '<div class="text-center py-8 text-slate-400"><p>Belum ada catatan</p></div>';
            notesCount.textContent = '0';
            return;
        }

        notesCount.textContent = currentNotes.length;
        notesList.innerHTML = currentNotes.map((note, index) => `
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 hover:bg-slate-100 transition">
                <p class="text-sm text-slate-600 mb-2">${note}</p>
                <div class="flex gap-2 justify-end">
                    <button onclick="editNote(${index})"
                        title="Edit"
                        class="p-1.5 text-amber-500 hover:bg-amber-50 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="deleteNoteItem(${index})"
                        title="Hapus"
                        class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');
    }

    function editNote(index) {
        document.getElementById('detailNotesTextarea').value = currentNotes[index];
        // Scroll ke input
        document.getElementById('detailNotesTextarea').focus();
        document.getElementById('detailNotesTextarea').scrollIntoView({ behavior: 'smooth' });
    }

    function deleteNoteItem(index) {
        if (!confirm('Hapus catatan ini?')) return;
        
        currentNotes.splice(index, 1);
        saveAllNotes();
        renderNotesList();
    }

    function showDetail(id) {
        currentReportId = id;
        fetch(`/admin/reports/${id}/detail`)
            .then(r => r.json())
            .then(data => {
                document.getElementById('detailKodeModal').textContent = data.kode_tracking;
                document.getElementById('detailJenis').textContent     = data.jenis_kejadian;
                document.getElementById('detailLokasi').textContent    = data.lokasi;
                document.getElementById('detailDeskripsi').textContent = data.deskripsi;
                document.getElementById('detailPhone').textContent     = data.phone || 'Tidak disediakan';

                // Parse notes - jika ada notes, split by line breaks
                currentNotes = data.notes ? data.notes.split('\n').filter(n => n.trim()) : [];
                document.getElementById('detailNotesTextarea').value = '';

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

                // Reset ke tab detail
                switchDetailTab('detail');

                document.getElementById('detailModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memuat detail laporan.');
            });
    }

    function saveNotes() {
        const newNote = document.getElementById('detailNotesTextarea').value.trim();
        
        if (!newNote) {
            alert('Catatan tidak boleh kosong');
            return;
        }

        // Add to array
        currentNotes.push(newNote);
        
        // Save all to backend
        saveAllNotes(() => {
            document.getElementById('detailNotesTextarea').value = '';
            renderNotesList();
        });
    }

    function saveAllNotes(callback) {
        const notes = currentNotes.join('\n');
        
        if (!currentReportId) {
            alert('Report ID tidak valid');
            return;
        }

        fetch(`/admin/reports/${currentReportId}/notes`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ notes: notes })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                if (callback) callback();
            } else {
                alert('❌ Gagal menyimpan: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('❌ Gagal menyimpan catatan');
        });
    }

    function deleteNotes() {
        if (!currentReportId) {
            alert('Report ID tidak valid');
            return;
        }

        if (!confirm('Hapus semua catatan? Tindakan ini tidak dapat dibatalkan.')) {
            return;
        }

        fetch(`/admin/reports/${currentReportId}/notes`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                currentNotes = [];
                document.getElementById('detailNotesTextarea').value = '';
                renderNotesList();
            } else {
                alert('❌ Gagal menghapus: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('❌ Gagal menghapus catatan');
        });
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = '';
        currentReportId = null;
        currentNotes = [];
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetail();
    });
</script>
</body>
</html>