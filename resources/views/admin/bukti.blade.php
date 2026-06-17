<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bukti Fisik - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .tabel-scroll {
        max-height: calc(100vh - 420px);
        overflow-y: auto;
    }
    .tabel-scroll thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: white;
    }
</style>
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
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Bukti Fisik</h1>
                </div>
                <a href="{{ route('admin.bukti.create') }}" class="flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Bukti
                </a>
            </header>
 
            <div class="flex-1 overflow-auto p-8">
                @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif
 
                <!-- Filter & Search -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-6">
                    <form action="{{ route('admin.bukti.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        <!-- Filter Kode Tracking -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Cari ID Kasus</label>
                            <input type="text" 
                                name="kode_tracking" 
                                value="{{ request('kode_tracking') }}"
                                placeholder="Contoh: SU-GXJAMB"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Filter Lokasi Simpan -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Cari Lokasi Simpan</label>
                            <input type="text" 
                                name="lokasi_simpan" 
                                value="{{ request('lokasi_simpan') }}"
                                placeholder="Contoh: ruang arsip rak 3"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Filter Status -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Status Bukti</label>
                            <select name="status_bukti" 
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                @foreach(['Disimpan','Dipinjam','Dipindahkan','Dimusnahkan','Dikembalikan'] as $status)
                                    <option value="{{ $status }}" 
                                        {{ request('status_bukti') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-end gap-2">
                            <button type="submit" 
                                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition">
                                Cari
                            </button>

                            @if(request()->hasAny(['kode_tracking', 'lokasi_simpan', 'status_bukti']))
                                <a href="{{ route('admin.bukti.index') }}" 
                                class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                
                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Daftar Bukti Fisik</h2>
                        <span class="text-sm text-gray-500">Total: <span class="font-semibold text-indigo-600">{{ $buktis->total() }}</span> item</span>
                    </div>
                    <div class="tabel-scroll overflow-y-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Bukti</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Kasus</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi Simpan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Masuk</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($buktis as $bukti)
                                <tr class="hover:bg-gray-50 transition cursor-pointer" onclick="showBuktiDetail({{ $bukti->id_bukti }})">
                                    <!-- ID Bukti -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-indigo-600">
                                        #{{ $bukti->id_bukti }}
                                    </td>

                                    <!-- Nama Barang -->
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                        <p class="font-medium truncate">{{ $bukti->nama_barang ?? '-' }}</p>
                                        @if($bukti->file_bukti)
                                            <p class="text-xs text-gray-400 mt-0.5">Ada file digital</p>
                                        @endif
                                    </td>

                                    <!-- ID Kasus -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="font-medium text-gray-700">{{ $bukti->laporan?->kode_tracking ?? '-' }}</span>
                                    </td>

                                    <!-- Lokasi Simpan -->
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $bukti->lokasi_simpan ?? '-' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColor = match($bukti->status_bukti) {
                                                'Disimpan'     => 'bg-green-100 text-green-800',
                                                'Dipinjam'     => 'bg-yellow-100 text-yellow-800',
                                                'Dipindahkan'  => 'bg-blue-100 text-blue-800',
                                                'Dimusnahkan'  => 'bg-red-100 text-red-800',
                                                'Dikembalikan' => 'bg-gray-200 text-gray-700',
                                                default        => 'bg-gray-100 text-gray-600',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                            {{ $bukti->status_bukti ?? 'Disimpan' }}
                                        </span>
                                    </td>

                                    <!-- Tanggal Masuk -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $bukti->created_at->format('d/m/Y') }}
                                    </td>

                                    <!-- Kolom AKSI -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.bukti.edit', $bukti->id_bukti) }}"
                                            class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                            title="Edit Status & Lokasi">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            {{-- Tombol Arsip & Hapus hanya muncul jika laporan sudah Selesai --}}
                                            @if(Auth::user()->role === 'super_admin' && $bukti->laporan?->status === 'Selesai' && !in_array($bukti->status_bukti, ['Dimusnahkan','Dikembalikan']))
                                                
                                                <!-- Tombol Arsip -->
                                                <button type="button"
                                                        dusk="btn-archive-{{ $bukti->id_bukti }}"
                                                        onclick="showArchiveModal({{ $bukti->id_bukti }})"
                                                        class="p-1.5 text-orange-500 hover:bg-orange-50 rounded-lg transition"
                                                        title="Arsipkan Bukti">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                                    </svg>
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('admin.bukti.destroy', $bukti->id_bukti) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus bukti ini secara permanen?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            dusk="btn-delete-{{ $bukti->id_bukti }}"
                                                            class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition"
                                                            title="Hapus Bukti Permanen">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M19 7l-.7 12.3a2 2 0 01-2 1.7H7.7a2 2 0 01-2-1.7L5 7m5 4v6m4-6v6m1-10V6a1 1 0 00-1-1h-4a1 1 0 00-1 1v1"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                        d="M21 21l-6-6m2-5a7 7 0 01-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                                <p class="text-lg font-medium text-gray-500">Data yang dicari tidak ditemukan</p>
                                                <p class="text-sm mt-1">Coba ubah kata kunci atau reset filter pencarian.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endempty
                            </tbody>
                        </table>
                    </div>

                    @if($buktis->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">
                        {{ $buktis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Arsip Bukti -->
    <div id="archiveModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[100]">
        <div class="bg-white rounded-2xl w-full max-w-md mx-4 overflow-hidden">
            
            <!-- Header -->
            <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="font-semibold text-lg">Arsipkan Bukti Fisik</h3>
                <button onclick="hideArchiveModal()" class="text-2xl text-gray-400 hover:text-gray-600">×</button>
            </div>

            <form id="archiveForm" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PATCH')   {{-- ← INI YANG PENTING --}}
                
                <input type="hidden" name="id" id="archiveBuktiId">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Status Akhir</label>
                    <select name="status_bukti" class="w-full border border-gray-300 rounded-xl px-4 py-2.5" required>
                        <option value="Dikembalikan">Dikembalikan</option>
                        <option value="Dimusnahkan">Dimusnahkan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-2.5" 
                            placeholder="Alasan mengarsipkan bukti..."></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="hideArchiveModal()" 
                            class="px-5 py-2.5 rounded-xl border text-gray-600 hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-orange-600 text-white hover:bg-orange-700">
                        Arsipkan
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    function showArchiveModal(id) {
        document.getElementById('archiveBuktiId').value = id;
        document.getElementById('archiveForm').action = `/admin/bukti/${id}/archive`;
        document.getElementById('archiveModal').classList.remove('hidden');
    }

    function hideArchiveModal() {
        document.getElementById('archiveModal').classList.add('hidden');
    }
</script>
</body>
</html>
