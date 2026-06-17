<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Jenis Kejadian - SpeakUp Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <h1 class="text-2xl font-bold text-gray-900">Kategori Jenis Kejadian</h1>
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

                {{-- Alert Sukses --}}
                @if(session('success'))
                <div id="alert-success" class="mb-6 flex items-start gap-3 rounded-xl bg-green-50 border border-green-200 p-4 text-green-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium">Berhasil!</p>
                        <p class="text-sm text-green-600">{{ session('success') }}</p>
                    </div>
                    <button onclick="document.getElementById('alert-success').remove()" class="text-green-400 hover:text-green-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                <!-- Table Card -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <!-- Card Header -->
                    <div class="border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-indigo-100 rounded-xl p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Daftar Kategori</h2>
                                <p class="text-sm text-gray-500">Total {{ $kategoris->total() }} kategori terdaftar</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.kategori.create') }}"
                           class="flex items-center gap-2 bg-indigo-600 text-white px-4 py-2.5 rounded-xl hover:bg-indigo-700 transition text-sm font-semibold shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Kategori
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Tanggal Dibuat</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($kategoris as $index => $kategori)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-8 py-4 text-sm text-gray-500">
                                        {{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full {{ $kategori->is_active ? 'bg-green-400' : 'bg-gray-300' }}"></div>
                                            <span class="text-sm font-semibold text-gray-900">{{ $kategori->nama_kategori }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-600">
                                            {{ $kategori->deskripsi ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($kategori->is_active)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $kategori->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                               title="Edit"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-amber-100 text-amber-700 hover:bg-amber-200 transition text-xs font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            {{-- Tombol Delete --}}
                                            <button
                                               onclick="confirmDelete({{ $kategori->id }}, '{{ addslashes($kategori->nama_kategori) }}')"
                                               title="Hapus"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition text-xs font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-16 text-center">
                                        <div class="flex flex-col items-center gap-3 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            <p class="text-sm font-medium">Belum ada kategori</p>
                                            <a href="{{ route('admin.kategori.create') }}" class="text-sm text-indigo-600 hover:underline">
                                                Tambah kategori pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($kategoris->hasPages())
                    <div class="px-8 py-4 border-t border-gray-200 flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            Menampilkan {{ $kategoris->firstItem() }}–{{ $kategoris->lastItem() }} dari {{ $kategoris->total() }} kategori
                        </p>
                        <div class="flex items-center gap-1">
                            {{-- Previous --}}
                            @if($kategoris->onFirstPage())
                                <span class="px-3 py-1.5 rounded-lg text-sm text-gray-300 cursor-not-allowed">
                                    &lsaquo; Sebelumnya
                                </span>
                            @else
                                <a href="{{ $kategoris->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">
                                    &lsaquo; Sebelumnya
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($kategoris->getUrlRange(1, $kategoris->lastPage()) as $page => $url)
                                @if($page == $kategoris->currentPage())
                                    <span class="px-3 py-1.5 rounded-lg text-sm bg-indigo-600 text-white font-semibold">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if($kategoris->hasMorePages())
                                <a href="{{ $kategoris->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">
                                    Berikutnya &rsaquo;
                                </a>
                            @else
                                <span class="px-3 py-1.5 rounded-lg text-sm text-gray-300 cursor-not-allowed">
                                    Berikutnya &rsaquo;
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-red-50 px-6 py-5 border-b border-red-100 flex items-center gap-3">
            <div class="bg-red-100 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <div class="px-6 py-5">
            <p class="text-sm text-gray-700">Apakah Anda yakin ingin menghapus kategori:</p>
            <p class="mt-1 text-base font-bold text-gray-900" id="deleteKategoriName"></p>
            <p class="mt-3 text-xs text-red-600 bg-red-50 rounded-lg p-3 border border-red-100">
                ⚠️ Data yang sudah dihapus tidak dapat dikembalikan.
            </p>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition text-sm font-medium">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition text-sm font-semibold">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, nama) {
        document.getElementById('deleteKategoriName').textContent = '"' + nama + '"';
        document.getElementById('deleteForm').action = '/admin/kategori/' + id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Tutup modal saat klik backdrop
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
